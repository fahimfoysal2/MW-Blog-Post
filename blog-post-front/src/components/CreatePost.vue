<template>
    <div class="create-post">
        <form v-on:submit.prevent>
            <input type="text" placeholder="title" v-model="newPost.title">
            <div>
                <textarea v-model="newPost.details"></textarea>
            </div>
            <button @click="createNewPost">Create Post</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "CreatePost",
    data() {
        return {
            newPost: {
                title  : '',
                details: '',
            }
        }
    },
    methods: {
        createNewPost() {
            axios.post('http://127.0.0.1:8000/api/posts',
                this.newPost,
                {
                    headers: {'Authorization': 'Bearer ' + this.$store.state.token}
                })
                .then(response => {
                    console.log("Post Created");
                    console.log(response.data);
                })
                .catch(reason => {
                    console.log(reason.data);
                });
        }
    }
}
</script>

<style scoped>

</style>
