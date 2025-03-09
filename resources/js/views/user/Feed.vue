<template>
    <div>
        <div class="px-6" v-if="posts">
            <h1 class="text-3xl">Posts</h1>
            <Post v-for="post in posts" :post="post"/>
        </div>
        <div class="p-6 text-center text-red-500" v-else>No posts...</div>
    </div>
</template>

<script>
import axios from "axios";
import Post from "../Post.vue";
export default {
    name: "Feed",
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
            axios.get(`/api/users/following_posts`)
                .then(res => {
                    this.posts = res.data.data
                })
        },
    },
}
</script>

<style scoped>

</style>
