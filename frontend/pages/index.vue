<template>
  <div class="container">
    <div class="container-fluid">
      <h2>User Management</h2>
      <NuxtLink to="/create-user" class="btn btn-primary btn-create" role="button">
        Create User
      </NuxtLink>
      <b-table
        id="my-table"
        :fields="fields"
        :items="users"
        :per-page="perPage"
        :current-page="currentPage"
        :striped="true"
        :bordered="true"
        :hover="true"
      >
        <template #cell(index)="data">
          {{ data.index + 1 + (perPage * currentPage - 10) }}
        </template>
        <template #cell(feature)="data">
          <button type="button" class="btn btn-primary btn-sm" @click="openDetailModal(data.item)">
            Detail
          </button>
          <NuxtLink :to="{ name: 'update-user-id', params: { id: data.item.id } }" class="btn btn-success btn-sm" role="button">
            Update
          </NuxtLink>
          <button type="button" class="btn btn-danger btn-sm" @click="openDeleteModal(data.item.id)">
            Delete
          </button>
        </template>
      </b-table>
      <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        align="center"
        aria-controls="my-table"
      />
      <DetailModal ref="detailModal" :user-detail="userDetail" />
      <DeleteModal ref="deleteModal" :user-id="userId" @user-deleted="userDeleted" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { ref, computed } from '@vue/composition-api'
import DetailModal from '../components/DetailModal'
import DeleteModal from '../components/DeleteModal'

const getUserList = (users) => {
  axios.get(`${process.env.baseUrl}/api/user`)
    .then((response) => {
      users.value = response.data
    })
}

export default {
  components: { DetailModal, DeleteModal },
  setup (props, { refs }) {
    const perPage = ref(10)
    const currentPage = ref(1)
    const userId = ref(0)
    const userDetail = ref({})
    const users = ref([])
    const fields = ref([
      'index',
      { key: 'full_name', label: 'Full Name' },
      'birthday',
      'phone',
      'feature'
    ])

    getUserList(users)

    const rows = computed(() => {
      return users.value.length
    })

    const openDetailModal = (user) => {
      userDetail.value = user
      const element = refs.detailModal.$el
      $(element).modal('show')
    }

    const openDeleteModal = (id) => {
      userId.value = id
      const element = refs.deleteModal.$el
      $(element).modal('show')
    }

    const userDeleted = () => {
      getUserList(users)
    }

    return {
      userId,
      userDetail,
      users,
      openDetailModal,
      openDeleteModal,
      userDeleted,
      perPage,
      currentPage,
      rows,
      fields
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
