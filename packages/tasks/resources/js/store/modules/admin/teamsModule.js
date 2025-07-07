import axios from 'axios'
import Cookie from 'cookie-universal';
const cookie = Cookie();

const api = axios.create({
  baseURL: 'http://localhost:8000/api/admin/teams',
    headers: {
        Authorization: `Bearer ${cookie.get('token')}`,
        "Content-Type":"application/json",
        'Accept-Language': localStorage.getItem('locale')
  }
})

export default {
  namespaced: true,
  state: {
    teams: [],
    team:{},
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
    SET_TEAMS(state, teams) {
      state.teams = teams
      },
    SET_TEAM(state, team) {
        state.team= team
    },
    ADD_TEAM(state, team) {
      state.teams.push(team)
    },
    UPDATE_TEAM(state, team) {
      const index = state.teams.findIndex(t => t.id === team.id)
      if (index !== -1) {
        state.teams.splice(index, 1, team)
      }
    },
    DELETE_TEAM(state, id) {
      state.teams = state.teams.filter(t => t.id !== id)
    }
  },
  actions: {
    async fetchTeams({ commit }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.get('/')
        commit('SET_TEAMS', response.data.teams)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to fetch teams')
      } finally {
        commit('SET_LOADING', false)
      }
    },
      async showTeam({ commit }, id) {
        commit('SET_LOADING', true)
      try {
        const response = await api.get(`/${id}`)
        commit('SET_TEAM', response.data.team)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to show team')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },

        async makeManger({ commit }, data) {
            commit('SET_LOADING', true)
            try {
                const response = await api.patch('/', data)
                commit('ADD_MEMBER', response.data.member)
                commit('SET_ERROR', null)
                return response.data
            } catch (error) {
                commit('SET_ERROR', error.message || 'Failed to create member')
                throw error
            } finally {
                commit('SET_LOADING', false)
            }
        },
      async createTeam({ commit }, data) {
      commit('SET_LOADING', true)
      try {
          const response = await api.post('/', data)
          console.log(response.data.team)
        commit('ADD_TEAM', response.data.team)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to create team')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
      },

 async updateTeam({ commit }, { id, data }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.put(`/${id}`, data)
        commit('UPDATE_TEAM', response.data.team)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to update team')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },
    async deleteTeam({ commit }, id) {
      commit('SET_LOADING', true)
      try {
        await api.delete(`/${id}`)
        commit('DELETE_TEAM', id)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to delete team')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },


  },
  getters: {
    getTeamyById: (state) => (id) => {
      return state.teams.find(t => t.id === id)
    }
  }
}
