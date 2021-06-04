<template>
  <UpdateForm :title="title" :user="user" />
</template>

<script lang="ts">
import axios from 'axios'
import { ref, defineComponent } from '@vue/composition-api'
import UpdateForm from '../../components/UpdateForm.vue'

export default defineComponent ({
  components: { UpdateForm },
  setup (props, { root }) {
    const title = ref('Update User')
    const user = ref({})

    axios.get(`${process.env.baseUrl}/api/user/${(<any>root)._route.params.id}`)
      .then((response) => {
        user.value = response.data
      })

    return { title, user }
  }
})
</script>
