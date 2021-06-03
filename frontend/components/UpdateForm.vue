<template>
  <div class="container">
    <div class="container-fluid">
      <h2>{{ title }}</h2>
      <form>
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
        <div id="button-group" class="form-group">
          <NuxtLink to="/" class="btn btn-secondary" role="button">
            Back
          </NuxtLink>
          <button type="submit" class="btn btn-primary" @click.prevent="submitForm">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { reactive } from '@vue/composition-api'
let alertify
if (process.client) {
  alertify = require('alertifyjs')
}

export default {
  props: {
    title: {
      type: String,
      required: true
    },
    user: {
      type: Object,
      required: true
    }
  },
  setup (props, { refs, root }) {
    let errors = reactive({})

    const submitForm = async () => {
      const fullName = refs.fullName.value
      const birthday = refs.birthday.value
      const address = refs.address.value
      const phone = refs.phone.value
      const sex = refs.sex.value
      const effectiveDate = refs.effectiveDate.value
      const expireDate = refs.expireDate.value
      const department = refs.department.value
      const skillTags = refs.skillTags.value
      const type = refs.type.value
      const note = refs.note.value
      let image = ''
      const imageFile = refs.image.files[0]

      const config = {
        headers: { 'content-type': 'multipart/form-data' }
      }

      const formData = new FormData()
      formData.append('file', imageFile)

      await axios.post(`${process.env.baseUrl}/api/user/upload-image`, formData, config)
        .then((response) => {
          image = response.data.image
        })
        .catch((error) => {
          console.log(error)
        })

      axios.put(`${process.env.baseUrl}/api/user/${root._route.params.id}`, {
        full_name: fullName,
        birthday,
        address,
        phone,
        sex,
        effective_date: effectiveDate,
        expire_date: expireDate,
        department,
        skill_tags: skillTags,
        type,
        note,
        image
      })
        .then(() => {
          alertify.success('Update success')
        })
        .catch((e) => {
          errors = e.response.data.errors
          Object.keys(errors).forEach((key) => {
            const error = errors[key]
            alertify.error(error[0])
          })
        })
    }

    return { errors, submitForm }
  }
}
</script>

<style scoped>
  h2 {
    margin-top: 20px;
    text-align: center;
  }
  #button-group {
    margin-bottom: 50px;
  }
</style>
