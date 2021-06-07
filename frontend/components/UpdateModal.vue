<template>
  <div id="updateModal" class="modal fade" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="updateModalLabel" class="modal-title">
            Update User
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="fullName">Full Name</label>
            <input id="fullName" ref="fullName" type="text" class="form-control" :value="user.full_name">
          </div>
          <div class="form-group">
            <label for="birthday">Birthday</label>
            <input id="birthday" ref="birthday" type="date" class="form-control" :value="user.birthday">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input id="address" ref="address" type="text" class="form-control" :value="user.address">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input id="phone" ref="phone" type="number" class="form-control" :value="user.phone">
          </div>
          <div class="form-group">
            <label for="sex">Sex</label>
            <select id="sex" ref="sex" class="form-control" :value="user.sex">
              <option value="1">
                男性
              </option>
              <option value="2">
                女性
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <div class="custom-file">
              <input id="image" ref="image" type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="image">Choose file</label>
            </div>
          </div>
          <div class="form-group">
            <label for="effectiveDate">Effective Date</label>
            <input id="effectiveDate" ref="effectiveDate" type="date" class="form-control" :value="user.effective_date">
          </div>
          <div class="form-group">
            <label for="expireDate">Expire Date</label>
            <input id="expireDate" ref="expireDate" type="date" class="form-control" :value="user.expire_date">
          </div>
          <div class="form-group">
            <label for="department">Department</label>
            <select id="department" ref="department" class="form-control" :value="user.department">
              <option value="1">
                Web
              </option>
              <option value="2">
                iOS
              </option>
              <option value="3">
                Android
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="skillTags">Skill Tags</label>
            <input id="skillTags" ref="skillTags" type="text" class="form-control" :value="user.skill_tags">
          </div>
          <div class="form-group">
            <label for="type">Type</label>
            <select id="type" ref="type" class="form-control" :value="user.type">
              <option value="1">
                社員
              </option>
              <option value="2">
                派遣
              </option>
              <option value="3">
                フリーランス
              </option>
              <option value="4">
                その他
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="note">Note</label>
            <input id="note" ref="note" type="text" class="form-control" :value="user.note">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary" @click="updateUser">
            OK
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import axios from 'axios'
import HTMLInputElement from 'bootstrap-vue'
import { reactive, defineComponent, ref } from '@vue/composition-api'
declare var $: any
let alertify: any
if (process.client) {
  alertify = require('alertifyjs')
}

const getElementValue = (input: any): any => {
  return input.value.value
}

export default defineComponent ({
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  setup (props, { emit }) {
    let errors = reactive({})
    const fullName = ref(HTMLInputElement)
    const birthday = ref(HTMLInputElement)
    const address = ref(HTMLInputElement)
    const phone = ref(HTMLInputElement)
    const sex = ref(HTMLInputElement)
    const effectiveDate = ref(HTMLInputElement)
    const expireDate = ref(HTMLInputElement)
    const department = ref(HTMLInputElement)
    const skillTags = ref(HTMLInputElement)
    const type = ref(HTMLInputElement)
    const note = ref(HTMLInputElement)
    const image = ref(HTMLInputElement)

    const updateUser = async (): Promise<void> => {
      let imageSrc = ''

      const config = {
        headers: { 'content-type': 'multipart/form-data' }
      }

      const formData = new FormData()
      formData.append('file', image.value.files[0])

      await axios.post(`${process.env.baseUrl}/api/user/upload-image`, formData, config)
        .then((response): void => {
          imageSrc = response.data.image
        })
        .catch((error): void => {
          console.log(error)
        })

      axios.put(`${process.env.baseUrl}/api/user/${props.user.id}`, {
        full_name: getElementValue(fullName),
        birthday: getElementValue(birthday),
        address: getElementValue(address),
        phone: getElementValue(phone),
        sex: getElementValue(sex),
        effective_date: getElementValue(effectiveDate),
        expire_date: getElementValue(expireDate),
        department: getElementValue(department),
        skill_tags: getElementValue(skillTags),
        type: getElementValue(type),
        note: getElementValue(note),
        image: imageSrc
      })
        .then(() => {
          $('#updateModal').modal('hide')
          emit('refresh-user-list')
          alertify.success('Update success')
        })
        .catch((e) => {
          errors = e.response.data.errors

          for (const [key, value] of Object.entries(errors)) {
            alertify.error(`${value}`)
          }
        })
    }

    return {
      errors,
      updateUser,
      fullName,
      birthday,
      address,
      phone,
      sex,
      effectiveDate,
      expireDate,
      department,
      skillTags,
      type,
      note,
      image
    }
  }
})
</script>

<style scoped>

</style>
