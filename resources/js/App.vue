<template>
    <div>
        <div class="mx-auto max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-2xl">
            <nav class="flex justify-center space-x-4 py-3">
                <router-link v-if="!token" class="font-medium rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900" :to="{name: 'user.login'}">Login</router-link>
                <router-link v-if="!token" class="font-medium rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900" :to="{name: 'user.register'}">Registration</router-link>
                <router-link v-if="token" class="font-medium rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900" :to="{name: 'user.personal'}">Personal</router-link>
                <router-link v-if="token" class="font-medium rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900" :to="{name: 'user.feed'}">Feed</router-link>
                <router-link v-if="token" class="font-medium rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900" :to="{name: 'user.index'}">Users</router-link>
                <a v-if="token" @click.prevent="logout" href="#" class="font-medium rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">Logout</a>
            </nav>

            <router-view></router-view>
        </div>

    </div>
</template>

<script>
export default {
    name: "App",
    data(){
        return {
            token: null
        }
    },

    mounted() {
        this.getToken()
    },

    methods: {
        getToken(){
            this.token = localStorage.getItem('auth')
        },
        logout(){
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('auth')
                    this.$router.push({name: 'user.login'})
                })
        }
    },
    watch: {
        $route(to, from) {
            this.getToken()
        }
    },
}
</script>

<style scoped>

</style>
