<template>
  <div class="container">
    <Loading v-if="loading"/>
    <div v-if="!loading" class="row h-100 justify-content-center align-items-center">
      <form class="col-md-9" @keydown="form.onKeydown($event)" @submit.prevent="login">
        <div class="AppForm shadow-lg">
          <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
              <div class="AppFormLeft">
                <h1 class="mb-3">Login</h1>
                <div class="form-group position-relative mb-4">
                  <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }"
                         class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                         name="email"
                         placeholder="E-Mail"
                         type="email"
                  >
                  <i class="fa fa-user"></i>
                  <has-error :form="form" field="email"/>
                </div>
                <div class="form-group position-relative mb-4">
                  <input id="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }"
                         class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none"
                         name="password"
                         placeholder="Password"
                         type="password"
                  >
                  <has-error :form="form" field="password"/>
                  <i class="fa fa-key"></i>

                </div>
                <div class="row  mt-4 mb-4">
                  <div class="col-md-6">
                    <div class="form-check">
                      <input id="defaultCheck1" v-model="remember" class="form-check-input" name="remember"
                             type="checkbox"
                      >
                      <label class="form-check-label" for="defaultCheck1">
                        {{ $t('remember_me') }}
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6 text-right">
                    <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
                      {{ $t('forgot_password') }}
                    </router-link>
                  </div>
                </div>


                <v-button :loading="form.busy" class="btn btn-success btn-block border-0 py-2 text-uppercase ">
                  {{ $t('login') }}
                </v-button>

                <p class="text-center mt-5">
                  Don't have an account?
                  <span><router-link to="/register">Create your account </router-link> </span>
                </p>

              </div>

            </div>
            <div class="col-md-6 quote">
              <div
                class="AppFormRight position-relative d-flex justify-content-center flex-column align-items-center text-center p-5 text-white"
              >
                <h2 class="position-relative px-4 pb-3 mb-4">Welcome</h2>
                <p>{{ quote.content }}</p>
                <p class="mt-2 font-weight-bold">{{ quote.author }}</p>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import axios from 'axios'
import Loading from '../../components/Loading'

export default {
  components: { Loading },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    quote: null,
    loading: true,
    remember: false
  }),
  beforeMount () {
    this.getQuote()
  },
  methods: {
    async getQuote () {
      try {
        const response = await axios.get('http://api.quotable.io/random?minLength=80')
        this.quote = response.data
        this.loading = false
      } catch (err) {
        this.quote.content = 'Life is a gift, and it offers us the privilege, opportunity, and responsibility to give something back by becoming more'
        this.quote.author = 'Tony Robbins'
      }
    },
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')
      console.log(data)

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Get permissions
      window.permsData = await axios.get('/api/roles', { headers: { Authorization: 'Bearer ' + data.token } })
      console.log("perms:" + window.permsData);
      this.$store.dispatch('auth/savePerms', {
        perms: permsData,
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
<style scoped>

* {
  padding: 0;
  margin: 0;
  outline: none;
}

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

body {
  font-family: 'Roboto', sans-serif !important;
  height: 100vh;
  color: #3a3e42 !important;
}

.AppForm {
  /*min-width: 720px;*/
}

.AppForm .AppFormLeft h1 {
  font-size: 35px;
}

.AppForm .AppFormLeft input:focus {
  border-color: #ced4da;
}

.AppForm .AppFormLeft input::placeholder {
  font-size: 15px;
}

.AppForm .AppFormLeft i {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
}

input {
  padding-left: 10px;
}
.AppForm .AppFormLeft a {
  color: #3a3e42;
}

.AppForm .AppFormLeft button {
  background: var(--sidebar-active-link);
  border-radius: 30px;
  transition: all 0.3s;
}

.AppForm .AppFormLeft button:hover {
  opacity: 0.9;
}

/* Change the white to any color */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
  -webkit-box-shadow: 0 0 0 30px white inset !important;
}

.form-check-input {
  position: relative !important;
}

.AppForm .AppFormLeft p span {
  color: #007bff;
}

.AppForm .AppFormRight {
  background-image: url('https://i2.wp.com/i.pinimg.com/originals/a3/8e/66/a38e66e215b90a6edc273189798777ad.jpg');
  height: 450px;
  background-size: cover;
  background-position: center;
}
.AppForm .AppFormRight:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, #8D334C, #CF6964);
  opacity: 0.5;
}

.AppForm .AppFormRight h2 {
  z-index: 1;
}

.AppForm .AppFormRight h2::after {
  content: "";
  position: absolute;
  width: 100%;
  height: 2px;
  background-color: #fff;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

.AppForm .AppFormRight p {
  z-index: 1;
}


</style>
