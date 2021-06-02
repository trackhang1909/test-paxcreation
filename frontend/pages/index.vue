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
              <NuxtLink :to="{ name: 'update-user-id', params: { id: user.id } }" class="btn btn-success btn-sm" role="button">
                Update
              </NuxtLink>
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
import { ref } from '@vue/composition-api'
import DetailModal from '../components/DetailModal'
import DeleteModal from '../components/DeleteModal'

export default {
  components: { DetailModal, DeleteModal },
  setup () {
    const userId = ref(0)
    const userDetail = ref({})
    const users = ref([])

    const openDetailModal = (user) => {
      userDetail.value = user
      const element = this.$refs.detailModal.$el
      $(element).modal('show')
    }

    const openDeleteModal = (id) => {
      userId.value = id
      const element = this.$refs.deleteModal.$el
      $(element).modal('show')
    }

    const userDeleted = () => {
      axios.get(`${process.env.baseUrl}/api/user`)
        .then((response) => {
          users.value = response.data
        })
    }

    return {
      userId,
      userDetail,
      users,
      openDetailModal,
      openDeleteModal,
      userDeleted
    }
  },
  async asyncData () {
    const response = await axios.get(`${process.env.baseUrl}/api/user`)
    return {
      users: response.data,
      userId: 0,
      userDetail: {}
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
