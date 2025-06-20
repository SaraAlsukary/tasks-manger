<template>
    <div class="flex justify-center align-middle" v-if="!cookie.get('token')">
        There are no tasks you should login, <span>Please login first</span>
    </div>
</template>
<script setup>
import Cookie from 'cookie-universal'
const cookie = Cookie()
</script>
