import './bootstrap';
import {createApp} from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import { routes } from '../../packages/tasks/resources/js/router/routes'
import {store} from '../../packages/tasks/resources/js/store/store'
import App from './App.vue';// Import theme CSS
import 'primeicons/primeicons.css';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/nora';
import { ToastService } from 'primevue';
const router = createRouter({
    history: createWebHistory(),
    routes,
})



const app = createApp(App)
app.use(router)
app.use(store)
app.use(ToastService)
app.use(PrimeVue,{
    theme: {
        preset:Aura
    }
})
 app.mount('#app')
