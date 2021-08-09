<template>
  <div>


    <nav v-if="!user" class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container">
        <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
          {{ appName }}
        </router-link>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false"
        >
          <span class="navbar-toggler-icon"/>
        </button>

        <div id="navbarToggler" class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <locale-dropdown/>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
          </ul>

          <ul class="navbar-nav ml-auto">
            <!-- Authenticated -->

            <!-- Guest -->
            <template>
              <li class="nav-item">
                <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                  {{ $t('login') }}
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                  {{ $t('register') }}
                </router-link>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>


    <nav v-if="user" class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <router-link to="/unused" class="nav-link">Unused</router-link>
        </li>

        <li class="nav-item">
          <locale-dropdown />
        </li>
      </ul>



      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown d-flex align-items-center">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <img :src="user.photo_url" class="rounded-circle profile-photo mr-1"> <i class="fas fa-sort-down"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ user.name }}</span>
            <div class="dropdown-divider"></div>
            <router-link :to="{ name: 'settings.profile' }" class="dropdown-item">
              <fa icon="cog" fixed-width/>
              {{ $t('settings') }}
            </router-link>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" @click.prevent="logout">
              <fa icon="sign-out-alt" fixed-width/>
              {{ $t('logout') }}
            </a>
          </div>
        </li>
      </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img :src="BASE_URL + '/goggles.svg'" alt="LavueAdmin Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ appName }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-0">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
              <router-link to="/home" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Home
                </p>
              </router-link>
            </li>

            <li class="nav-item" v-if="can('role_view')">
              <router-link to="/roles" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Roles
                </p>
              </router-link>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'
const { BASE_URL } = require('../config')
export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName,
    BASE_URL: BASE_URL,
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
a.nav-link{
  width: 100%!important;
}
</style>
