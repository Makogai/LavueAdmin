<template>
  <div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form @submit.prevent="edit" @keydown="form.onKeydown($event)">
          <div class="modal-header">
            <h4 class="modal-title">Edit Role</h4>
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input v-model="role.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required type="text" autofocus>
              <has-error :form="form" field="name" />
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn btn-default" id="closeEdit" data-dismiss="modal" @click.prevent="closeModal" type="button" value="Cancel">
            <v-button :loading="form.busy" type="success">
              {{ $t('update') }}
            </v-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Cookies from 'js-cookie'
import Form from 'vform'

export default {
  name: 'edit',
  data: () => ({
    form: new Form({
      name: ''
    }),
  }),
  props: {
    role: Object
  },
  methods: {
    closeModal () {
      this.form.reset()
      this.form.errors.errors = {};
    },
    async edit () {
      this.form.name = this.role.name;
      let response = await this.form.put(`http://localhost:8000/api/role/${this.role.id}`, { headers: { Authorization: 'Bearer ' + Cookies.get('token') } })
      Toast.fire({
        icon: 'success',
        title: response.data.message
      })
      this.form.reset()
      $("#closeEdit").click();
      this.$emit('addedRole')
    }
  },
}
</script>

<style scoped>

</style>
