import axios from 'axios'

export const state = () => ({
  users: []
})

export const mutations = {
  setUsers(state, users) {
    state.users = users
  }
}

export const actions = {
  nuxtServerInit(vuexContext) {
    axios.get(`${process.env.baseUrl}/api/user`)
      .then((response) => {
        vuexContext.commit('setUsers', response.data)
      })
  },
  setUsers(vuexContext, users) {
    vuexContext.commit('setUsers', users)
  }
}

export const getters = {
  users(state) {
    return state.users
  }
}

