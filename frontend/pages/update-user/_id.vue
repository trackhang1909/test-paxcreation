<template>
  <UpdateForm :title="title" :user="user" />
</template>

<script>
import axios from 'axios'
import { ref } from '@vue/composition-api'
import UpdateForm from '../../components/UpdateForm'

export default {
  components: { UpdateForm },
  setup (props, { root }) {
    const title = ref('Update User')
    const user = ref({})

    axios.get(`${process.env.baseUrl}/api/user/${root._route.params.id}`)
      .then((response) => {
        user.value = response.data
      })

    return { title, user }
  }
}
</script>
