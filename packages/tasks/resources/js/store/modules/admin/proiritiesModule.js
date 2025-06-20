import axios from 'axios'
import Cookie from 'cookie-universal';
const cookie = Cookie();
const api = axios.create({
    baseURL: 'http://localhost:8000/api/admin/proirities',
    headers: {
      Authorization: `Bearer ${cookie.get('token')}`
  }
})

export default {
  namespaced: true,
  state: {
    proirities: [],
    loading: false,
    error: null
  },
  mutations: {
    SET_LOADING(state, isLoading) {
      state.loading = isLoading
    },
    SET_ERROR(state, error) {
      state.error = error
    },
    SET_PROIRITIES(state, proirities) {
      state.proirities = proirities
    },
    ADD_PROIRITY(state, proirity) {
      state.proirities.push(proirity)
    },
    UPDATE_PROIRITY(state, proirity) {
      const index = state.proirities.findIndex(p => p.id === proirity.id)
      if (index !== -1) {
        state.proirities.splice(index, 1, proirity)
      }
    },
    DELETE_PROIRITY(state, id) {
      state.proirities = state.proirities.filter(pro => pro.id !== id)
    }
  },
  actions: {
    async fetchProirities({ commit }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.get('/')
        commit('SET_PROIRITIES', response.data)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to fetch proirities')
      } finally {
        commit('SET_LOADING', false)
      }
    },

  async createProirity({ commit }, data) {
      commit('SET_LOADING', true)
      try {
        const response = await api.post('/', userData)
        commit('ADD_PROIRITY', response.data)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to create proirity')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
      },

 async updateProirity({ commit }, { id, userData }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.put(`/${id}`, userData)
        commit('UPDATE_PROIRITY', response.data)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to update proirity')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },
    async deleteProirity({ commit }, id) {
      commit('SET_LOADING', true)
      try {
        await api.delete(`/${id}`)
        commit('DELETE_PROIRITY', id)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to delete user')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },


  },
  getters: {
    getProirityById: (state) => (id) => {
      return state.proirities.find(pro => pro.id === id)
    }
  }
}
