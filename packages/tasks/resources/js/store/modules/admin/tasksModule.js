import axios from 'axios'
import Cookie from 'cookie-universal';
const cookie = Cookie();
const api = axios.create({
  baseURL: 'http://localhost:8000/api/admin/tasks',
    headers: {
        Authorization: `Bearer ${cookie.get('token')}`,
        "Content-Type":"application/json",
        'Accept-Language': localStorage.getItem('locale')
  }
})

export default {
  namespaced: true,
  state: {
    tasks: [],
    task:{},
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
    SET_TASKS(state, tasks) {
      state.tasks = tasks
    },
    SET_TASK(state, task) {
        state.task=task
    },
    ADD_TASK(state, task) {
      state.tasks.push(task)
    },
    UPDATE_TASK(state, task) {
      const index = state.tasks.findIndex(t => t.id === task.id)
      if (index !== -1) {
        state.tasks.splice(index, 1, task)
      }
    },
    DELETE_TASK(state, id) {
      state.tasks = state.tasks.filter(t => t.id !== id)
    }
  },
  actions: {
    async fetchTasks({ commit }) {
      commit('SET_LOADING', true)
      try {
          const response = await api.get('/')
        commit('SET_TASKS', response.data.tasks)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to fetch tasks')
      } finally {
        commit('SET_LOADING', false)
      }
    },

  async createTasks({ commit }, data) {
      commit('SET_LOADING', true)
      try {
        const response = await api.post('/', data)
        commit('ADD_TASK', response.data.task)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to create data')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
      },

 async updateTasks({ commit }, { id, data }) {
      commit('SET_LOADING', true)
      try {
        const response = await api.put(`/${id}`, data)
        commit('UPDATE_TASK', response.data)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to update data')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
      },

 async showTask({ commit }, id ) {
      commit('SET_LOADING', true)
      try {
        const response = await api.get(`/${id}`, data)
        commit('SET_TASK', response.data.task)
        commit('SET_ERROR', null)
        return response.data
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to show task')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },
    async deleteTasks({ commit }, id) {
      commit('SET_LOADING', true)
      try {
        await api.delete(`/${id}`)
        commit('DELETE_TASK', id)
        commit('SET_ERROR', null)
      } catch (error) {
        commit('SET_ERROR', error.message || 'Failed to delete task')
        throw error
      } finally {
        commit('SET_LOADING', false)
      }
    },


  },
  getters: {
    getTaskById: (state) => (id) => {
      return state.tasks.find(t => t.id === id)
    }
  }
}
