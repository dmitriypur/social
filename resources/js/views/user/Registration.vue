<template>
    <div>
        <div class="p-4">
            <input v-model="name" type="text" placeholder="Name" class="w-full block p-2 rounded-sm border border-sky-500">
            <input v-model="email" type="email" placeholder="E-mail" class="w-full block p-2 mt-3 rounded-sm border border-sky-500">
            <input v-model="password" type="password" placeholder="Password" class="w-full block p-2 mt-3 rounded-sm border border-sky-500">
            <input v-model="password_confirmation" type="password" placeholder="password confirmation"
                   class="w-full block p-2 mt-3 rounded-sm border border-sky-500">
            <input @click.prevent="register" type="submit" value="Register" class="w-full bg-sky-500 hover:bg-sky-600 text-white p-2 mt-3 rounded-sm">
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Registration",
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        }
    },

    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(res => {
                        console.log(res);
                        if(res){
                            localStorage.setItem('auth', 'auth')
                            this.$router.push({name: 'user.personal'})
                        }
                    })
            });
        }
    }
}
</script>

<style scoped>

</style>
