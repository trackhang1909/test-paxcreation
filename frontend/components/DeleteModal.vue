<template>
  <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="deleteModalLabel" class="modal-title">
            User
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete user {{ userId }}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-danger" @click="deleteUser">
            OK
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { toRefs } from '@vue/composition-api'
let alertify
if (process.client) {
  alertify = require('alertifyjs')
}

export default {
  props: {
    userId: {
      type: Number,
      required: true
    }
  },
  setup (props, { emit }) {
    const { userId } = toRefs(props)
    const deleteUser = () => {
      axios.delete(`${process.env.baseUrl}/api/user/${userId.value}`)
        .then(() => {
          $('#deleteModal').modal('hide')
          emit('user-deleted')
          alertify.success('Delete success')
        })
    }

    return { deleteUser }
  }
}
</script>
