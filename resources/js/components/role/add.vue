<template>
  <div id="addEmployeeModal" class="modal fade rounded-lg">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form @submit.prevent="add" @keydown="form.onKeydown($event)">
          <div class="modal-header">
            <h4 class="modal-title">{{$t('add_role')}}</h4>
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>{{$t('name')}}</label>
              <input v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"  required type="text">
              <has-error :form="form" field="name" />
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn btn-default" id="closeAdd" data-dismiss="modal" type="button" value="Cancel">
            <v-button :loading="form.busy" type="success">
              {{ $t('add') }}
            </v-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
export default {
  name: 'add',
  data: () => ({
    form: new Form({
      name: ''
    })
  }),
  methods: {
    async add () {
      let response = await this.form.post('http://localhost:8000/api/role', { headers: { Authorization: 'Bearer ' + Cookies.get('token') } })
      Toast.fire({
        icon: 'success',
        title: response.data.message
      })
      this.form.reset()
      $("#closeAdd").click();
      this.$emit('addedRole')
    }
  }
}
</script>

<style scoped>

</style>
