<template>
    <!-- component -->

    <div class="header flex align bg-gray-800 text-white top-0 py-3 flex-wrap justify-around bg-silver">
        <h1 class="text-lg font-semibold">Task app</h1>
        <ul class="flex align  gap-[40px] text-m">

            <li>
                <router-link class="nav-item mx-2" :class="{ 'active': isHomeActive | isDashActive }"
                    :to="(user?.role === 'user' && user) ? { name: 'home' } : (user?.role === 'admin' && user) ? { name: 'dashboard' } : { name: 'home' }">
                    {{ $t('Home') }}
                </router-link>
            </li>
            <li> <router-link :class="{ 'active': isTasksActive | isTaskAdminActive }" class="nav-item mx-2"
                    :to="(user?.role === 'user' && user) ? { name: 'tasks' } : (user?.role === 'admin' && user) ? { name: 'admin.tasks' } : { name: 'tasks' }">

                    {{ $t('Tasks') }}

                </router-link></li>
            <li v-if="(user && user?.role === 'admin')">
                <router-link :class="{ 'active': isProiritiyActive }" class="nav-item mx-2"
                    :to="{ name: 'admin.proirities' }">

                    {{ $t('Proirities') }}

                </router-link>
            </li>
            <li v-if="(user && user?.role === 'admin')">
                <router-link :class="{ 'active': isMembersActive }" class="nav-item mx-2"
                    :to="{ name: 'admin.members' }">

                    {{ $t('Members') }}

                </router-link>
            </li>
            <li>
                <router-link :class="{ 'active': isTeamsActive | isTeamAdminActive }" class="nav-item mx-2"
                    :to="(user?.role === 'user' && user) ? { name: 'teams' } : (user?.role === 'admin' && user) ? { name: 'admin.teams' } : { name: 'teams' }">

                    {{ $t('Teams') }}

                </router-link>
            </li>
            <li>
                <Select :eventChange="switchLanguage" :options="options" />
            </li>
            <li v-if="isAuth">
                <router-link :class="{ 'active': isProfileActive }" class="nav-item mx-2" :to="{ name: 'profile' }">
                    {{ user?.name }}
                </router-link>
            </li>

            <li v-else>
                <router-link :class="{ 'active': isLoginActive }" class="nav-item mx-2" :to="{ name: 'login' }">
                    <Button text="Login" />
                </router-link>
            </li>

        </ul>
    </div>



</template>
<script>
import Button from '../components/Button/Button.vue'
import Cookie from 'cookie-universal'
const cookie = Cookie()
import Select from '../components/Select/Select.vue'
import translateMixin from '../mixins/translation'
export default {
    mixins: [translateMixin],
    methods: {
        switchLanguage(e) {
            const lang = e.target.value
            const path = window.location.pathname
            window.location.href = `${path}?lang=${lang}`;
        }
    },
    data() {
        return {
            options: [
                { name: this.$t('lang'), code: '' },
                { name: this.$t('English'), code: 'en' },
                { name: this.$t('Arabic'), code: 'ar' }
            ]
        };
    },
    components: {
        Button,
        Select
    },
    computed: {


        isHomeActive() {
            return this.$route.name === 'home'
        },
        isDashActive() {
            return this.$route.name === 'dashboard'
        },
        isTasksActive() {
            return this.$route.name === 'tasks'
        },
        isTeamsActive() {
            return this.$route.name === 'teams'
        },
        isLoginActive() {
            return this.$router.name === 'login'
        },
        isProfileActive() {
            return this.$route.name === 'profile'
        },
        isTeamAdminActive() {
            return this.$route.name === 'admin.teams'
        },
        isTaskAdminActive() {
            return this.$route.name === 'admin.tasks'
        },
        isProiritiyActive() {
            return this.$route.name === 'admin.proirities'
        },
        isMembersActive() {
            return this.$route.name === 'admin.members'
        },
        user() {
            return this.$store.getters['auth/currentUser'] || null
        },
        isAuth() {
            return cookie.get('token')
        },


    },

    mounted() {
        if (this.user) {
            try {
                const storedUser = JSON.parse(localStorage.getItem('user'))
                if (storedUser) {
                    this.$store.commit('auth/SET_USER', storedUser)
                }
            } catch (error) {
                console.error('Failed to parse user data:', error)
            }
        }
    }
}
</script>
<style scoped>
.align {
    align-items: center;
}

.header {
    position: fixed;
    width: 100%;
    z-index: 1000;
}

a {
    cursor: pointer;
    transition: .3s;
}

a.active {
    color: var(--main-color);
}

a:hover {
    color: var(--main-color);
}
</style>
