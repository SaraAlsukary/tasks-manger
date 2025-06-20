export const routes = [

  { path: '/', name:'home', component: ()=>import('../../../../../resources/js/pages/Home.vue') },
  { path: '/dashboard', name:'dashboard', component: ()=>import('../../../../../resources/js/pages/Dashboard.vue') },
  { path: '/profile', name:'profile', component: ()=>import('../../../../../resources/js/pages/Profile.vue') },
  { path: '/login', name:'login', component: ()=>import('../../../../../resources/js/pages/Login.vue') },
  { path: '/register', name:'register', component: ()=>import('../../../../../resources/js/pages/Register.vue') },
  { path: '/tasks', name:'tasks', component: ()=>import('../../../../../resources/js/pages/user/Tasks.vue') },
  { path: '/teams', name:'teams', component: ()=>import('../../../../../resources/js/pages/user/Teams.vue') },
  { path: '/dashboard/teams', name:'admin.teams', component: ()=>import('../../../../../resources/js/pages/admin/Teams/Teams.vue') },
  { path: '/dashboard/tasks', name:'admin.tasks', component: ()=>import('../../../../../resources/js/pages/admin/Tasks/Tasks.vue') },
  { path: '/dashboard/proirities', name:'admin.proirities', component: ()=>import('../../../../../resources/js/pages/admin/Proirities/Proirities.vue') },
  { path: '/dashboard/members', name:'admin.members', component: ()=>import('../../../../../resources/js/pages/admin/Members/Members.vue') },


]

