<template>
  <div class="container">
    <div class="container-fluid">
      <h2>User Management</h2>
      <NuxtLink to="/create-user" class="btn btn-primary btn-create" role="button">
        Create User
      </NuxtLink>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">
              #
            </th>
            <th scope="col">
              Full Name
            </th>
            <th scope="col">
              Birthday
            </th>
            <th scope="col">
              Phone
            </th>
            <th scope="col">
              Feature
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users" :key="index">
            <th scope="row">
              {{ index + 1 }}
            </th>
            <td>
              {{ user.full_name }}
            </td>
            <td>
              {{ user.birthday }}
            </td>
            <td>
              {{ user.phone }}
            </td>
            <td>
              <button type="button" class="btn btn-primary btn-sm" @click="openDetailModal(user)">
                Detail
              </button>
              <button type="button" class="btn btn-success btn-sm">
                Update
              </button>
              <button type="button" class="btn btn-danger btn-sm" @click="openDeleteModal(user.id)">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <DetailModal ref="detailModal" :user-detail="userDetail" />
      <DeleteModal ref="deleteModal" :user-id="userId" @user-deleted="userDeleted" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import DetailModal from '../components/DetailModal'
import DeleteModal from '../components/DeleteModal'

export default {
  components: { DetailModal, DeleteModal },
  data () {
    return {
      userId: 0,
      userDetail: {},
      users: []
    }
  },
  head () {
    return {
      title: 'User Management'
    }
  },
  created () {
    axios.get('http://127.0.0.1:8000/api/user')
      .then((response) => {
        this.users = response.data
      })
  },
  methods: {
    openDetailModal (user) {
      this.userDetail = user
      const element = this.$refs.detailModal.$el
      $(element).modal('show')
    },
    openDeleteModal (id) {
      this.userId = id
      const element = this.$refs.deleteModal.$el
      $(element).modal('show')
    },
    userDeleted () {
      axios.get('http://127.0.0.1:8000/api/user')
        .then((response) => {
          this.users = response.data
        })
    }
  }
}
</script>

<style scoped>
  h2 {
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: center;
  }
  .btn-create {
    margin-bottom: 20px;
  }
</style>
