<template>
    <app-layout title="Post">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <post-list :posts="posts"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/Admin/AppLayout.vue'
    import PostList from '@/Partials/PostList.vue'

    export default defineComponent({
        components: {
            AppLayout,
            PostList
        },
        props: ['posts']
    })
</script>
