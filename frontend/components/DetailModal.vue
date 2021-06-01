<template>
  <div id="exampleModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">
            User Detail
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped table-borderless">
            <tbody>
              <tr>
                <td>Full name</td>
                <td>{{ userDetail.full_name }}</td>
              </tr>
              <tr>
                <td>Birthday</td>
                <td>{{ userDetail.birthday }}</td>
              </tr>
              <tr>
                <td>Address</td>
                <td>{{ userDetail.address }}</td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>{{ userDetail.phone }}</td>
              </tr>
              <tr>
                <td>Sex</td>
                <td>{{ sex[userDetail.sex - 1] }}</td>
              </tr>
              <tr>
                <td>Image</td>
                <td>{{ userDetail.image }}</td>
              </tr>
              <tr>
                <td>Effective date</td>
                <td>{{ userDetail.effective_date }}</td>
              </tr>
              <tr>
                <td>Expire date</td>
                <td>{{ userDetail.expire_date }}</td>
              </tr>
              <tr>
                <td>Department</td>
                <td>{{ department[userDetail.department - 1] }}</td>
              </tr>
              <tr>
                <td>Skill tags</td>
                <td>{{ userDetail.skill_tags }}</td>
              </tr>
              <tr>
                <td>Type</td>
                <td>{{ type[userDetail.type - 1] }}</td>
              </tr>
              <tr>
                <td>Note</td>
                <td>{{ userDetail.note }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    userDetail: {
      type: Object,
      required: true
    }
  },
  data () {
    return {
      sex: ['男性', '女性'],
      department: ['Web', 'iOS', 'Android'],
      type: ['社員', '派遣', 'フリーランス', 'その他']
    }
  }
}
</script>
