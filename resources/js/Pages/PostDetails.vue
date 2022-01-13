<template>
    <admin-app-layout v-if="$page.props.user.role  == $page.props.roles.admin"  title="Post">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <post-view :posts="posts"/>
                </div>
            </div>
        </div>
    </admin-app-layout>
    <staff-app-layout v-if="$page.props.user.role  == $page.props.roles.staff"  title="Post">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Post
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <post-view :posts="posts"/>
                </div>
            </div>
        </div>
    </staff-app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AdminAppLayout from '@/Layouts/Admin/AppLayout.vue'
import StaffAppLayout from '@/Layouts/Staff/AppLayout.vue'
import PostView from '@/Partials/PostView.vue'

export default defineComponent({

    components: {
        AdminAppLayout,
        PostView,
        StaffAppLayout
    },
    props: ['posts'],
    mounted(){

    }
})
</script>
