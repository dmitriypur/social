<template>
    <div>
        <div class="px-6">
            <h1 class="text-3xl">Posts</h1>
            <Post v-for="post in posts" :post="post"/>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Post from "../Post.vue";
export default {
    name: "Show",
    components: {Post},

    data(){
        return {
            posts: [],
            userId: this.$route.params.id
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(){
            axios.get(`/api/users/${this.userId}/posts`)
                .then(res => {
                    console.log(res);
                    this.posts = res.data.data
                })
        },
    },
}
</script>

<style scoped>

</style>
