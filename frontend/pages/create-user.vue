<template>
  <CreateForm :title="title" />
</template>

<script>
import CreateForm from '../components/CreateForm'

export default {
  components: { CreateForm },
  data () {
    return {
      title: 'Create User'
    }
  }
}
</script>
