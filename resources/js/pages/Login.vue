<template>


    <!-- component -->
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Log In</h2>

            <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="your@email.com" v-model="user.email" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="password" v-model="user.password" />
                </div>

                <!-- <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div> -->

                <Button type="submit" :disabled="loading" :text="loading ? 'Processing...' : 'Login'" class="w-full" />
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Don't have an account?
                <router-link class="text-indigo-600 hover:text-indigo-500 font-medium" :to="{ name: 'register' }">Create
                    new account</router-link>
            </div>
        </div>
    </div>
</template>
<script>
import Button from '../components/Button/Button.vue'
export default {
    components: {
        Button
    },
    data() {
        return {
            user: {
                email: "", 
                password: "",
            }
        }
    },
    computed: {
        // Remove mapState if still having issues and use local state instead
        loading() {
            return this.$store.state.auth?.loading || false
        },
        error() {
            return this.$store.state.auth?.error || null
        }
    },
    methods: {


        async handleSubmit() {
            try {
                // Corrected: use this.user instead of user
               await this.$store.dispatch('auth/login', this.user)
                    .then((response) => {
                        if (response.data.user.role === 'user')
                            this.$router.push({ name: 'home' })
                        else
                            this.$router.push({ name: 'dashboard' })

                    })

            } catch (error) {
                console.error("Registration failed:", error)
                // Error is already handled by Vuex
            }
        }
    }
}
</script>
