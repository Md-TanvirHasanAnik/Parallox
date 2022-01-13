<template>
<div class="flex flex-col p-10">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200" id="table_id">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Title
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Created At
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="post in posts">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" :src="route('index')+post.image" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{ post.title }}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span v-if="post.status == 1"  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Active
                </span>
                <span v-else  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                  Inactive
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ new Date(post.created_at).toLocaleString() }}
              </td>

              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium ">
                  <a @click.prevent="view(post.id)" class="cursor-pointer text-pink-600 hover:text-pink-900"> <button> View | </button></a>
                  <a v-if="post.status == 1" @click.prevent="inactive(post.id)" class="cursor-pointer text-indigo-600 hover:text-indigo-900"> Make Inactive </a>
                    <a v-else @click.prevent="active(post.id)" class="text-indigo-600 hover:text-indigo-900 cursor-pointer"> Make Active </a>
                <span>|</span> <a @click.prevent="deletePost(post.id)" class="text-red-600 hover:text-red-900 cursor-pointer"> Delete </a>
              </td>
            </tr>

            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</template>


<script>
    import { defineComponent } from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    import Swal from "sweetalert2";


    import "jquery/dist/jquery.min.js";
    //Datatable Modules
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    import {Link} from "@inertiajs/inertia-vue3";

    export default defineComponent({
        components: {
            Link
        },
        props: ['posts'],

        mounted: () => {
             $('#table_id').DataTable();
        },
        methods: {
            view(id)
            {
                Inertia.get(route('posts.view', id))
            },
            active(id)
            {
                Inertia.post(route('posts.active', id))
            },
            inactive(id)
            {
                Inertia.post(route('posts.inactive', id))
            },
            deletePost(id)
            {

                Inertia.delete(route('posts.destroy', id),{
                    onSuccess: () => {
                        Swal.fire({
                      icon: "success",
                      title: "Success",
                      text: "Posted Deleted Successfully",
                      position: "top-end",
                      showConfirmButton: false,
                      timer: 2500,
                  });
                    }
                })
            }
        }
    })
</script>

