<template>
  <form @submit.prevent="Register">
    <h1 class="title is-1">Please sign in</h1>
    <div class="columns is-mobile is-centered">
      <div class="column is-half">
        <div class="field is-horizontal">
          <div class="field-label">
            <label class="label">Name</label>
          </div>
          <input class="input" type="text" v-model="name" placeholder="Your fully name">
        </div>
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
          <a href="/login" class="button">Sign in</a>
          <button class="button is-success">Register</button>
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
    Register() {
      axios.post('http://localhost:8000/api/register',
          {
            name: this.name,
            email: this.email,
            password: this.password,
          })
          .then((res) => {
            localStorage.setItem('usertoken', res.data.token)
            localStorage.setItem('user_id', res.data.user.id)
            this.$router.push({path: "/"})
          })
          .catch((err) => {
            localStorage.removeItem('usertoken')
            console.log(err)
            this.message = 'Failed to register'
          })
    },
  }
}
</script>