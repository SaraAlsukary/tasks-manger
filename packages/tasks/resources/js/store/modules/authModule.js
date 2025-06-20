import axios from 'axios'
import Cookie from 'cookie-universal'
const api = axios.create({
    baseURL: 'http://localhost:8000/api/auth',

})
const cookie = Cookie()
export default {
  namespaced: true,
  state: {
    user: {},
    token:null,
    loading: false,
    error: null
  },
  mutations: {
    SET_LOADING(state, isLoading) {
      state.loading = isLoading
    },
    SET_TOKEN(state, token) {
      state.token = token
      },
    CLEAR_TOKEN(state) {
      state.token = null
    },
    SET_ERROR(state, error) {
      state.error = error
    },
    SET_USER(state, user) {
      state.user = user
    },
    CLEAR_USER(state) {
      state.user = null
      },

  },
  actions: {
    async register({ commit }, data) {
      commit('SET_LOADING', true)
      try {
          const response = await api.post('/register', data)
          cookie.set('token', response.data.authorisation.token)
          localStorage.setItem('user', JSON.stringify(response.data.user))
          commit('SET_TOKEN',response.data.user.authorisation.token)
          commit('SET_USER', response.data)
          commit('SET_ERROR', null)
          return response
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to register')
      } finally {
        commit('SET_LOADING', false)
      }
    },


  async login({ commit }, data) {
      commit('SET_LOADING', true)
      try {
          const response = await api.post('/login', data)
          cookie.set('token', response.data.authorisation.token)
          localStorage.setItem('user', JSON.stringify(response.data.user))
          commit('SET_USER', response.data)
          commit('SET_TOKEN',response.data.authorisation.token)
        commit('SET_ERROR', null)
        return response
      } catch (error) {

        commit('SET_ERROR', error.message || 'Failed to login')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
      },

 async logout({ commit }) {
      commit('SET_LOADING', true)
      try {
          const response = await api.post(`/logout`, {},
              {
                  headers: {
                      Authorization: `Bearer ${cookie.get('token')}`,

                }
            }
          )
          localStorage.removeItem('user')
          cookie.remove('token')
        commit('CLEAR_USER')
        commit('CLEAR_TOKEN')
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to logout')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },


  },
  getters: {
    currentUser: (state) => {
              return state.user
  }
  },
    isAuthenticated: state => state.token || cookie.get('token')
  }
