import { createStore } from 'vuex'
import proirityModule from './modules/admin/proiritiesModule'
import memberModule from './modules/admin/memberModule'
import teamModule from './modules/admin/teamsModule'
import taskModule from './modules/admin/tasksModule'
import authModule from './modules/authModule'

// Create a new store instance.
export const store = createStore({
    modules: {
        auth:authModule,
        proirity: proirityModule,
        member: memberModule,
        team: teamModule,
        task: taskModule,
    },
})
