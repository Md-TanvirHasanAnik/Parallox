<template>
      <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
           <div class="text-center">
              <h1 class="font-bold text-2xl"> Create A Post </h1>
              <form class="w-full max-w-6xl mx-auto my-5 bg-white p-5">
                  <jet-validation-errors class="mb-4" />
                  <div class="flex flex-wrap justify-center flex-col mx-auto mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mx-auto">
                      <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Title
                      </label>
                      <input v-model="form.title" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Please insert a title here!"/>
                <!--  <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mx-auto">
                      <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Description
                      </label>
                      <textarea v-model="form.description" class="h-40 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" ></textarea>
                      
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mx-auto">
                      <img id="photo" class="h-36 w-36 hidden">
                      <div class=" rounded-lg shadow-lg w-full">
                            <label for="file" class="w-full block flex items-center justify-center" >
                                <input @input="form.image = $event.target.files[0]" type="file" id="file" ref="photo" class="hidden" @change="updatePhotoPreview($event)" >
                                <button
                                    type="button"
                                    class=" py-1 px-2 bg-blue-800 text-gray-100 text-md rounded-lg focus:border-4 border-blue-300 hover:bg-blue-500"
                                    @click="selectNewPhoto"
                                >
                                    + Select Image
                                </button>
                            </label>
                      </div>
                    </div>

                    <div class="text-center">
                        <button @click="submit" type="button" class="m-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">POST</button>
                    </div>
                     
                  </div>
              </form>
           </div>
        </div>
      </div>  
</template>


<script>
    import Swal from "sweetalert2";
    import $ from "jquery";
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

    export default{
      data() {
          return {
          form: this.$inertia.form({
            title: "",
            description: "",
            image: ""
          })
        }
      },
     components: {
      JetValidationErrors,
     },
     methods:
      {
        selectNewPhoto(){
          this.$refs.photo.click();
        },
        updatePhotoPreview(input) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#photo').attr('src', e.target.result);
              $('#photo').removeClass('hidden');
          };
          reader.readAsDataURL(input.target.files[0]);
        },
        submit() {
            this.form.post( route('posts.store') ,
            {
              forceFormData: true,
              preserveScroll: true,
              onSuccess: () => {
                  Swal.fire({
                      icon: "success",
                      title: "Success",
                      text: "Posted Successfully",
                      position: "top-end",
                      showConfirmButton: false,
                      timer: 2500,
                  });
                  this.form.reset();
                    $('#photo').attr('src', "");
                    $('#photo').addClass('hidden');
                },
              
            });
        },
        
      }
    }

 </script>   