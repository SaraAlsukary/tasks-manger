<template>
    <!-- component -->
    <div
        class="sidebar bg-slate-100 overflow-y-scroll w-screen h-screen antialiased text-slate-300 selection:bg-blue-600 selection:text-white">
        <div class="flex flex-col relative w-screen ">
            <div id="menu"
                class="bg-gray-900 min-h-screen z-10 text-slate-300 w-64 fixed left-0 h-screen overflow-y-scroll">
                <div id="logo" class="my-4 px-6">
                    <h1 class="text-lg md:text-2xl font-bold text-white">{{ $t("Dash") }}<span class="text-blue-500">{{ $t("board") }}</span>.</h1>
                    <p class="text-slate-500 text-sm">{{ $t('manageActions') }}</p>
                </div>
                <div id="profile" class="px-6 py-10">
                    <p class="text-slate-500">{{ $t('welcomeBack') }}</p>
                    <a href="#" class="inline-flex space-x-2 items-center">
                        <span>
                            <img class="rounded-full w-8 h-8"
                                src="https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=128&q=80"
                                alt="">
                        </span>
                        <span class="text-sm md:text-base font-bold">
                            {{ user?.name }}
                        </span>
                    </a>
                </div>
                <div id="nav" class="w-full px-6">
                    <router-link :to="{ name: 'dashboard' }" :class="{ 'active': isDashActive }"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3  hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>

                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-5 text-white">{{ $t('Dashboard') }}</span>
                            <span class="text-sm text-white/50 hidden md:block">{{ $t('DataOverview') }}</span>
                        </div>
                    </router-link>
                    <router-link :to="{ name: 'admin.teams' }" :class="{ 'active': isTeamAdminActive }"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">{{ $t("Teams") }}</span>
                            <span class="text-sm text-slate-500 hidden md:block">{{ $t('TeamsManager') }}</span>
                        </div>
                    </router-link>
                    <router-link :to="{ name: 'admin.members' }" :class="{ 'active': isMembersActive }"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">{{ $t('Members') }}</span>
                            <span class="text-sm text-slate-500 hidden md:block">{{ $t('MemberManger') }}</span>
                        </div>
                    </router-link>
                    <router-link :to="{ name: 'admin.tasks' }" :class="{ 'active': isTaskAdminActive }"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">{{ $t('Tasks') }}</span>
                            <span class="text-sm text-slate-500 hidden md:block">{{ $t('ManageTasks') }}</span>
                        </div>
                    </router-link>
                    <router-link :to="{ name: 'admin.proirities' }" :class="{ 'active': isProiritiyActive }"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">{{ $t('Proirities') }}</span>
                            <span class="text-sm text-slate-500 hidden md:block">{{ $t('ManageProirities') }}</span>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
[dir='rtl'] .sidebar,
[dir="rtl"] #menu {
    right: 0;
}

.sidebar {
    position: relative;
    top: 50px;
    width: 256px;
}

a {
    cursor: pointer;
    transition: .3s;
}

a.active {
    background-color: rgb(35, 91, 247);
}
</style>
<script>
import translateMixin from '../../mixins/translation'
export default {
    mixins: [translateMixin],
    computed: {
        user() {
            return this.$store.getters['auth/currentUser'] || null
        },
        isAdmin() {
            return this.user?.role === 'admin'
        },
        isDashActive() {
            return this.$route.name === 'dashboard'
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

    }
}


</script>
