import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import axios from 'axios'
import VueAxios from 'vue-axios'
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
Vue.use(LaravelPermissionToVueJS);
import '~/plugins'
import '~/components'
Vue.component('Pagination', require('laravel-vue-pagination'));
Vue.config.productionTip = false

new Vue({
  i18n,
  store,
  router,
  axios,
  VueAxios,
  ...App
})
