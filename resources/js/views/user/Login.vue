<template>
    <div>
        <div class="p-4">
            <input v-model="email" type="email" placeholder="E-mail" class="w-full block p-2 rounded-sm border border-sky-500">
            <input v-model="password" type="password" placeholder="Password" class="w-full block p-2 mt-3 rounded-sm border border-sky-500">
            <input @click.prevent="login" type="submit" value="Login" class="w-full bg-sky-500 hover:bg-sky-600 text-white p-2 mt-3 rounded-sm">
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",

    data(){
        return {
            email: null,
            password: null
        }
    },
    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password})
                    .then(res => {
                        if(res){
                            localStorage.setItem('auth', 'auth')
                            this.$router.push({name: 'user.personal'})
                        }
                    })
                    .catch(err => {
                        console.log(err.response.data.message);
                    })
            });
        }
    }
}
</script>

<style scoped>

</style>
