import axios from 'axios'
import Cookie from 'cookie-universal';
const cookie = Cookie();
const api = axios.create({
    baseURL: 'http://localhost:8000/api/admin/members',
    headers: {
      Authorization: `Bearer ${cookie.get('token')}`
  }
})

export default {
  namespaced: true,
  state: {
    members: [],
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
    SET_MEMBERS(state, members) {
      state.members = members
    },
    ADD_MEMBER(state, member) {
      state.members.push(member)
    },
    UPDATE_MEMBER(state, member) {
      const index = state.members.findIndex(p => p.id === member.id)
      if (index !== -1) {
        state.members.splice(index, 1, member)
      }
    },
    DELETE_MEMBER(state, id) {
      state.members = state.member.filter(m => m.id !== id)
    }
  },
  actions: {
    async fetchMember({ commit }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.get('/')
        commit('SET_MEMBERS', response.data.members)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to fetch member')
      } finally {
        commit('SET_LOADING', false)
      }
    },

  async createMember({ commit }, data) {
      commit('SET_LOADING', true)
      try {
        const response = await api.post('/', data)
        commit('ADD_MEMBER', response.data)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to create member')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
      },

 async updateMember({ commit }, { id, data }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.put(`/${id}`, data)
        commit('UPDATE_MEMBER', response.data)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to update member')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },
    async deleteMember({ commit }, id) {
      commit('SET_LOADING', true)
      try {
        await api.delete(`/${id}`)
        commit('DELETE_MEMBER', id)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to delete member')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },


  },
  getters: {
    getMemberById: (state) => (id) => {
      return state.members.find(m => m.id === id)
    }
  }
}
