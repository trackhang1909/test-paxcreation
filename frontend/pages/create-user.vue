<template>
  <CreateForm :title="title" />
</template>

<script>
import { ref } from '@vue/composition-api'
import CreateForm from '../components/CreateForm'

export default {
  components: { CreateForm },
  setup () {
    const title = ref('Create User')

    return { title }
  }
}
</script>
