<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Register</h2>

            <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" v-model="user.name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="Your name" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" v-model="user.email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="your@email.com" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" v-model="user.password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="Password" required minlength="6" />
                </div>

                <Button type="submit" :disabled="loading" :text="loading ? 'Processing...' : 'Register'"
                    class="w-full" />

                <div v-if="error" class="text-red-500 text-sm mt-2">
                    {{ error }}
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <router-link :to="{ name: 'login' }" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    Login
                </router-link>
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
                name: "",
                email: "",
                password: "",
            }
        }
    },
    computed: {
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
                const response = await this.$store.dispatch('auth/register', this.user)
                    .then((response) => {
                        if (response.data.user.role === 'user')
                            this.$router.push({ name: 'home' })
                        else
                            this.$router.push({ name: 'dashboard' })

                    })
            } catch (error) {
                console.error("Registration failed:", error)
            }
        }
    }
}
</script>
