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
          Are you sure you want to delete {{ userId }}?
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

export default {
  props: {
    userId: {
      type: Number,
      required: true
    }
  },
  methods: {
    deleteUser () {
      axios.delete(`http://127.0.0.1:8000/api/user/${this.userId}`)
        .then((response) => {
          $('#deleteModal').modal('hide')
          this.$emit('user-deleted')
        })
    }
  }
}
</script>
