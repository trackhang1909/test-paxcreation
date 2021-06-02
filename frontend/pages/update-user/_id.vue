<template>
  <UpdateForm :title="title" :user="user" />
</template>

<script>
import axios from 'axios'
import UpdateForm from '../../components/UpdateForm'

export default {
  components: { UpdateForm },
  data () {
    return {
      title: 'Update User',
      user: {}
    }
  },
  created () {
    axios.get(`${process.env.baseUrl}/api/user/${this.$route.params.id}`)
      .then((response) => {
        this.user = response.data
      })
  }
}
</script>
