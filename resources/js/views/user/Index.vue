<template>
    <div class="p-4">
        <h1 class="text-xl">Users</h1>
        <div v-if="users">
            <div v-for="user in users" class="flex justify-between mb-8 py-6 border-b border-gray-300">
                <router-link :to="{name: 'user.show', params: {id: user.id}}">
                    <div>
                        <p class="text-zinc-800">{{ user.name }}</p>
                        <p class="text-zinc-500">{{ user.email }}</p>
                    </div>
                </router-link>
                <a href="#" @click.prevent="toggleFollowing(user)" :class="['block text-center py-1 px-4 mt-3 rounded-xl', user.is_followed ? 'bg-green-500 hover:bg-green-600 text-white' : 'border-2 border-green-500 hover:bg-green-500 text-green-500 hover:text-white']">{{ user.is_followed ? 'Unfollow' : 'Follow' }}</a>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";

export default {
    name: "Index",
    data(){
        return {
            users: []
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        toggleFollowing(user){
            axios.post(`/api/users/${user.id}/toggle_following`)
                .then(res => {
                    user.is_followed = res.data.is_followed
                })
        },
        getUsers(){
            axios.get('/api/users')
                .then(res => {
                    this.users = res.data.data
                })
        }
    }
}
</script>

<style scoped>

</style>
