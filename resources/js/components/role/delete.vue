<template>
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form @submit.prevent="deleteRole" @keydown="deleteRole">
          <div class="modal-header">
            <h4 class="modal-title">Delete Role</h4>
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this Role?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input class="btn btn-default" id="closeDelete" data-dismiss="modal"type="button" value="Cancel">
            <v-button :loading="loading" type="danger">
              {{ $t('delete') }}
            </v-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Cookies from 'js-cookie'
import axios from 'axios'
import Form from 'vform'

export default {
  name: 'delete',
  data: () => ({
    loading: false,
  }),
  props: {
    role: Object
  },
  methods: {
    async deleteRole () {
      this.loading = true;
      let response = await axios.delete(`http://localhost:8000/api/role/${this.role.id}`, { headers: { Authorization: 'Bearer ' + Cookies.get('token') } })
      Toast.fire({
        icon: 'success',
        title: response.data.message
      })
      $("#closeDelete").click();
      this.$emit('addedRole')
      this.loading = false;
    }
  },
}
</script>

<style scoped>

</style>
