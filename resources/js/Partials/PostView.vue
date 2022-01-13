<template>
    <div class="text-center" >
        <template v-for="(post, index ) in posts">
            <h1 class="text-xl"> {{ post.title }} </h1>
            <div class="bg-indigo-300 inline-block">
            <img class="object-cover w-96 " :src="route('index') + post.image">
            </div>
            <p> {{ post.description }} </p>

            <input class="w-96 mb-5 rounded" type="text" v-model="comments[index]">
            <button @click="submitComment(post.id , index)" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Comment
            </button>

            <h1>Comments</h1>
            <template  v-for="(comment, place) in post.comments" :key="place">
            <div class="w-96 mx-auto" v-if="comment.parent_id == null">
                <ul>
                    <li class="text-left">{{ comment.comment }}
                        <ul class="text-left">
                            <li class="ml-5" v-for="reply in comment.replies">
                                {{ reply.comment }}
                            </li>
                            <div class="flex">
                                <input class="w-96 rounded" type="text" v-model="reply[index][place]">
                                <button @click="submitReply(post.id, comment.id , index , place)" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                    Reply
                                </button>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
            </template>
        </template>
    </div>
</template>
<script>
import { defineComponent } from 'vue';
export default defineComponent({
    data () {
        return {
        comments: [],
        reply: [],
        form: this.$inertia.form({
            comment: ""
          }),
        formReply: this.$inertia.form({
            reply: "",
            comment_id: ""
        }),
        }
    },
    created() {
        for (let i = 0; i < this.posts.length; i++) {
            let row = [];
            for (let j = 0; j < this.posts[i].comments.length; j++) {
                row.push('');
            }
            this.reply.push(row);
        }
    },
    props: ['posts'],
    methods: {
        submitComment(id , index )
        {
            this.form.comment = this.comments[index];

            this.form.post( route('comment' , id) ,
            {
              forceFormData: true,
              preserveScroll: true,
              onSuccess: () => {
                  Swal.fire({
                      icon: "success",
                      title: "Success",
                      text: "Commented Successfully",
                      position: "top-end",
                      showConfirmButton: false,
                      timer: 2500,
                  });
                  this.form.reset();
                },

            });
        },
        submitReply(post_id, comment_id, index , place)
        {
            this.formReply.reply = this.reply[index][place];
            this.formReply.comment_id = comment_id;
            this.formReply.post( route('reply' , post_id) ,
                {
                    forceFormData: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Commented Successfully",
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2500,
                        });
                        this.form.reset();
                    },

                });
        }
    },

})
</script>
