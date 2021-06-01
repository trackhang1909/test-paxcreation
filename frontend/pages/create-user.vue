<template>
  <div class="container">
    <div class="container-fluid">
      <h2>Create User</h2>
      <form>
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input id="fullName" ref="fullName" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="birthday">Birthday</label>
          <input id="birthday" ref="birthday" type="date" class="form-control">
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input id="address" ref="address" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="phone">Phone</label>
          <input id="phone" ref="phone" type="number" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="sex">Sex</label>
          <select id="sex" ref="sex" class="form-control">
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
            <input id="image" type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01" required>
            <label class="custom-file-label" for="image">Choose file</label>
          </div>
        </div>
        <div class="form-group">
          <label for="effectiveDate">Effective Date</label>
          <input id="effectiveDate" ref="effectiveDate" type="date" class="form-control">
        </div>
        <div class="form-group">
          <label for="expireDate">Expire Date</label>
          <input id="expireDate" ref="expireDate" type="date" class="form-control">
        </div>
        <div class="form-group">
          <label for="department">Department</label>
          <select id="department" ref="department" class="form-control">
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
          <input id="skillTags" ref="skillTags" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select id="type" ref="type" class="form-control">
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
          <input id="note" ref="note" type="text" class="form-control">
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

export default {
  data () {
    return {
      errors: {}
    }
  },
  head () {
    return {
      title: 'Create User'
    }
  },
  methods: {
    submitForm () {
      const fullName = this.$refs.fullName.value
      const birthday = this.$refs.birthday.value
      const address = this.$refs.address.value
      const phone = this.$refs.phone.value
      const sex = this.$refs.sex.value
      const effectiveDate = this.$refs.effectiveDate.value
      const expireDate = this.$refs.expireDate.value
      const department = this.$refs.department.value
      const skillTags = this.$refs.skillTags.value
      const type = this.$refs.type.value
      const note = this.$refs.note.value

      axios.post('http://127.0.0.1:8000/api/user', {
        full_name: fullName,
        birthday,
        address,
        phone,
        image: '1111',
        sex,
        effective_date: effectiveDate,
        expire_date: expireDate,
        department,
        skill_tags: skillTags,
        type,
        note
      })
        .then((response) => {
          console.log(response.data)
        })
        .catch((e) => {
          this.errors = e.response.data.errors
        })
    }
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
