<script>
import Header from './layouts/header.vue'
import Footer from './layouts/footer.vue'
import Sidebar from './components/Sidebar/Sidebar.vue'

import { Toast } from 'primevue'
export default {

    components: {
        Header, Footer, Sidebar,Toast
    },
    computed: {
        user() {
            return this.$store.getters['auth/currentUser'] || null
        },
        isAdmin() {
            return this.user?.role === 'admin'
        },
    }
}



</script>
<template>
    <Header />
    <div class="user" v-if="!isAdmin">
        <router-view v-if="!isAdmin"></router-view>
    </div>
    <div class="admin" v-if="isAdmin">
        <Sidebar />
        <router-view class="content" v-if="isAdmin"></router-view>
    </div>
    <Footer v-if="!isAdmin" />
    <Toast />

</template>
<style scoped>
.admin {
    display: flex;
    justify-content: space-between;
}

.user {
    position: relative;
    top: 60px;
}

.content {
    width: calc(100% - 285px);
    left: 0;
    position: relative;
    bottom: -54px;
    transform: initial;
    padding: initial;
    padding: 100px 0;
}
</style>
