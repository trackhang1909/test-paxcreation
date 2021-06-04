<template>
  <CreateForm :title="title" />
</template>

<script lang="ts">
import { ref, defineComponent } from '@vue/composition-api'
import CreateForm from '../components/CreateForm.vue'

export default defineComponent ({
  components: { CreateForm },
  setup () {
    const title = ref('Create User')

    return { title }
  }
})
</script>
