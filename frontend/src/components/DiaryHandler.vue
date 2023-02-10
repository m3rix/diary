<template>
  <h1 class="title is-1">My diary</h1>
  <div class="columns">

    <div class="column is-half">
      <!--Edit mode -->
      <form v-if="edit_mode===true" @submit.prevent="editDiaryPost(edit_post)">
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Title</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control">
                <input class="input" type="text" v-model="title">
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Diary Text</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control">
                <textarea class="textarea" type="text" v-model="diary_text">
                </textarea>
              </p>
            </div>
          </div>
        </div>
        <button class="button">Upate</button>
        {{ message }}
      </form>
      <!--Add mode -->
      <form v-else @submit.prevent="AddNewDiaryPost">
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Title</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control">
                <input class="input" type="text" v-model="title" placeholder="Add a title to you diary post">
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Diary Text</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control">
                <textarea class="textarea" type="text" v-model="diary_text" placeholder="Add a text to your diary post">
                </textarea>
              </p>
            </div>
          </div>
        </div>
        <button class="button">Add</button>
        {{ message }}
      </form>
    </div>
    <div class="column is-half">
      <table class="table">
        <tbody>
        <tr v-for="diary_post in diary_posts" :key="diary_post">
          <td>{{ diary_post.title }}</td>
          <td>
            <form @submit.prevent="startEditDiaryPost(diary_post.id)">
              <button class="button is-success">Edit</button>
            </form>
          </td>
          <td>
            <form @submit.prevent="deleteDiaryPost(diary_post.id)">
              <button class="button is-danger">Delete</button>
            </form>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <form @submit.prevent="Logout">
    <button class="button is-danger">Logout</button>
  </form>
</template>
<script>
import axios from 'axios';

export default {

  data() {
    return {
      title: '',
      diary_text: '',
      diary_posts: '',
      message: '',
      edit_post: '',
      edit_mode: false
    }
  },

  methods: {
    AddNewDiaryPost() {
      axios.post('http://localhost:8000/api/v1/diary',
          {
            post_date: new Date().toISOString().slice(0, 19).replace('T', ' '),
            title: this.title,
            diary_text: this.diary_text,
            user_id: localStorage.user_id,
          })
          .then(response => this.ListDiaryPosts())
          .catch((err) => {
            console.error(err)
            this.message = 'Failed to add new diary post'
          })
    },
    ListDiaryPosts() {
      axios.get('http://localhost:8000/api/v1/diary/list/' + localStorage.user_id)
          .then(response => this.diary_posts = response.data)
          .catch((err) => {
            console.error(err)
            this.message = 'Could not list diary posts'
          })
    },
    deleteDiaryPost(id) {
      axios.delete('http://localhost:8000/api/v1/diary/' + id)
          .then(response => this.ListDiaryPosts())
          .catch((err) => {
            console.error(err)
            this.message = 'Could not delete diary post'
          })
    },
    startEditDiaryPost(id) {
      this.edit_mode = true;
      this.edit_post = id;
      axios.get('http://localhost:8000/api/v1/diary/' + id)
          .then(
              response => [
                this.title = response.data.data.title,
                this.diary_text = response.data.data.diary_text,
              ])
          .catch((err) => {
            console.error(err)
            this.message = 'Could not delete diary post'
          })
    },
    editDiaryPost(id) {
      this.edit_mode = false;
      axios.put('http://localhost:8000/api/v1/diary/' + id, {
        title: this.title,
        diary_text: this.diary_text,
        user_id: localStorage.user_id,
      })
          .then(
              response =>
                this.ListDiaryPosts(),
                this.title = '',
                this.diary_text = ''
          )
          .catch((err) => {
            console.error(err)
            this.message = 'Could not edit diary post'
          })
    },
    Logout() {
      localStorage.removeItem('usertoken')
      this.$router.push({path: "/login"})
    }
  },
  mounted() {
    if (!localStorage.usertoken) {
      this.$router.push('login')
    }
    this.ListDiaryPosts();
  }
}
</script>