<template>
  <form @submit.prevent="Login">
    <h1 class="title is-1">Please sign in</h1>
    <div class="columns is-mobile is-centered">
      <div class="column is-half">
    <div class="field is-horizontal">
      <div class="field-label">
        <label class="label">Email Address</label>
      </div>
      <input class="input" type="email" v-model="email" placeholder="EmailAddress">
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Password</label>
      </div>
      <input class="input" type="password" v-model="password" placeholder="Password">
    </div>
        <div class="buttons is-centered">
          <button class="button is-success">Sign in</button>
          <a href="/register" class="button">Register</a>
          {{message}}
        </div>

      </div>
    </div>
  </form>
</template>
<script>
import axios from 'axios';

export default {

  data() {
    return {
      email: '',
      password: '',
      message: '',
    }
  },

  methods: {
    Login() {
      axios.post('http://localhost:8000/api/login',
          {
            email: this.email,
            password: this.password,
          })
          .then((res) => {
            localStorage.setItem('user_id', res.data.user.id);
            localStorage.setItem('usertoken', res.data.token);
            this.$router.push({ path: "/" })
          })
          .catch((err) => {
            this.message = 'Failed to log in'
            localStorage.removeItem('user_id')
            localStorage.removeItem('usertoken')
            console.log(err)
          })
    },
  }
}
</script>