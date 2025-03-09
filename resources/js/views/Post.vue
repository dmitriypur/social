<template>
    <div class="mb-8 py-6 border-b border-gray-300">
        <div v-if="post.image_url" class="mb-4 p-2 bg-gray-100 rounded-lg">
            <img class="rounded-md w-full h-auto" :src="post.image_url" alt="">
        </div>
        <div>{{ post.content }}</div>

        <div class="mt-2 w-full flex justify-between items-center">
            <div class="flex items-center">
                <svg @click="toggleLike(post)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" :class="['size-6', post.is_liked ? 'fill-sky-500 stroke-sky-500' : 'fill-white stroke-sky-500 hover:fill-sky-200']">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                <span class="ml-2 text-sm text-gray-500">{{ post.likes_count }}</span>
            </div>
            <p class="text-sm text-right text-zinc-400">{{ post.date }}</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Post",
    props: {
        post: Object
    },
    methods: {
        toggleLike(post){
            axios.post(`/api/posts/${post.id}/toggle_like`)
                .then(res => {
                    console.log(res);
                    post.is_liked = res.data.is_liked
                    post.likes_count = res.data.likes_count
                })
        },
    }
}
</script>
