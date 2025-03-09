<template>
    <div>
        <div class="p-4">
            <div class="p-2">
                <textarea v-model="content" placeholder="Enter text" class="w-full block p-2 rounded-sm border border-sky-500"></textarea>
                <div class="flex items-start justify-between">
                    <input @change="storeImage" ref="file" type="file" class="hidden">
                    <a href="#" @click.prevent="selectFile" class="block text-center bg-green-500 hover:bg-green-600 text-white py-1 px-4 mt-3 rounded-xl">Image</a>
                    <a href="#" @click.prevent="image = null" class="block text-center bg-red-500 hover:bg-red-600 text-white py-1 px-4 mt-3 rounded-xl">Cancel</a>
                </div>
                <div v-if="image" class="p-2 bg-gray-100 mt-2">
                    <img :src="image.url" alt="">
                </div>
                <a href="#" @click.prevent="store" class="block text-center w-full bg-sky-500 hover:bg-sky-600 text-white p-2 mt-3 rounded-sm">Publish</a>
            </div>
        </div>
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
    name: "Personal",
    components: {Post},

    data(){
        return {
            content: '',
            image: null,
            posts: [],
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        getPosts(){
            axios.get('/api/posts')
                .then(res => {
                    this.posts = res.data.data
                })
        },
        store(){
            let id = this.image ? this.image.id : null
            axios.post('/api/posts', {content: this.content, image_id: id})
                .then(res => {
                    if(res.status === 201){
                        this.content = ''
                        this.image = null

                        this.posts.unshift(res.data.data)
                    }
                })
        },
        selectFile(){
            this.fileInput = this.$refs.file
            this.fileInput.click()
        },
        storeImage(e){
            const file = e.target.files[0]
            const formData = new FormData()
            formData.append('image', file)

            axios.post('/api/post_image', formData)
                .then(res => {
                    this.image = res.data.data
                })
        }
    },
}
</script>

<style scoped>

</style>
