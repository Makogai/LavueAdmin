<template>
  <div class="main-layout wrapper">
    <navbar v-if="user" />
    <aside v-if="user" class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <div :class="$route.path === '/login' ? 'container' : 'content-wrapper pt-5'">
      <child />

    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import { mapGetters } from 'vuex'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  },
  computed: mapGetters({
    user: 'auth/user'
  })
}
</script>
