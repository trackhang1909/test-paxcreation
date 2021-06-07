<template>
  <div class="container">
    <div class="container-fluid">
      <h2>User Management</h2>
      <button type="button" class="btn btn-primary btn-create" @click="openCreateModal">
        Create User
      </button>
      <CreateModal ref="createModal" @refresh-user-list="refreshUserList" />
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
          <button type="button" class="btn btn-success btn-sm" @click="openUpdateModal(data.item)">
            Update
          </button>
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
      <UpdateModal ref="updateModal" :user="userDetail" @refresh-user-list="refreshUserList" />
      <DeleteModal ref="deleteModal" :user-id="userId" @refresh-user-list="refreshUserList" />
    </div>
  </div>
</template>

<script lang="ts">
import axios from 'axios'
import { ref, computed, defineComponent } from '@vue/composition-api'
import DetailModal from '../components/DetailModal.vue'
import DeleteModal from '../components/DeleteModal.vue'
import CreateModal from '../components/CreateModal.vue'
import UpdateModal from '../components/UpdateModal.vue'
declare var $: any

const getUserList = (users: any) => {
  axios.get(`${process.env.baseUrl}/api/user`)
    .then((response) => {
      users.value = response.data
    })
}

export default defineComponent ({
  components: { DetailModal, DeleteModal, CreateModal, UpdateModal },
  setup (props, { root, refs }) {
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

    const rows = computed((): number => {
      return users.value.length
      // return root.$store.getters.users.length
    })

    const openCreateModal = (): void => {
      const element = (<Vue>refs.createModal).$el
      $(element).modal('show')
    }

    const openDetailModal = (user: {}): void => {
      userDetail.value = user
      const element = (<Vue>refs.detailModal).$el
      $(element).modal('show')
    }

    const openUpdateModal = (user: {}): void => {
      userDetail.value = user
      const element = (<Vue>refs.updateModal).$el
      $(element).modal('show')
    }

    const openDeleteModal = (id: number) : void => {
      userId.value = id
      const element = (<Vue>refs.deleteModal).$el
      $(element).modal('show')
    }

    const refreshUserList = (): void => {
      getUserList(users)
    }

    return {
      userId,
      userDetail,
      users,
      openCreateModal,
      openDetailModal,
      openUpdateModal,
      openDeleteModal,
      refreshUserList,
      perPage,
      currentPage,
      rows,
      fields
    }
  }
})
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
