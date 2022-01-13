<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
          

            <div class="max-w-2xl mx-auto">

	<div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
	
		<div  class="flex flex-col items-center p-10">
			<img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://parallaxlogic.com/assets/img/favicon.png" alt="Bonnie image">
			<h3 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">ParallaxLogic Infotech Test</h3>
			<span class="text-sm text-gray-500 dark:text-gray-400">Developed by Md Tanvir Hasan Anik</span>
            <div v-if="$page.props.user" class="flex justify-center mt-4 space-x-3 lg:mt-6">
				<Link :href="route('dashboard')"
					class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Dashboard</Link>
			
			</div>
			<div v-else class="flex mt-4 space-x-3 lg:mt-6">
				<Link :href="route('login')"
					class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</Link>
				<Link :href="route('register')"
					class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-800">Register</Link>
			</div>
		</div>
	</div>

</div>
        </div>
    </div>
</template>


<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    })
</script>
