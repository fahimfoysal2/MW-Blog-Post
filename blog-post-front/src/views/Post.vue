<template>
    <div class="post">
        <h3>{{ post.title }}</h3>
        <small>
            <a href="#">
                {{ post.user.name }}
            </a>
        </small>
        <div class="postData">
            <div class="post-content">
                <p>{{ post.details }}</p>
            </div>
        </div>
        <hr>
        <div class="comments">
            <h5>Comments</h5>

            <div class="create-comment">
                <input type="text" name="new_comment" id="new_comment" v-model="newComment.comment">
                <button @click="createComment" :disabled="emptyCommentBox">Comment</button>
            </div>

            <div v-for="commentData in allComments" class="comment">
                <a href="#">{{ commentData.user.name }}</a>
                <p class="comment-text">{{ commentData.comment }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    data() {
        return {
            post       : {
                id     : 1,
                title  : "Post Title",
                details: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut, corporis delectus deleniti earum eius est laboriosam laudantium modi molestias nisi obcaecati provident quae, quam quidem totam vitae voluptatibus!",
                user   : {
                    name: "Fahim Foysal",
                    id  : 1,
                }
            },
            allComments: [
                {
                    id     : 1,
                    comment: "Nice Post",
                    user   : {
                        id  : 2,
                        name: 'Fahim'
                    }
                }
            ],

            newComment: {
                post_id: this.$route.params.id,
                comment: '',
            }

        }

    }
    ,
    mounted() {
        axios.get('http://127.0.0.1:8000/api/posts/' + this.$route.params.id,
            {
                headers: {'Authorization': 'Bearer ' + this.$store.state.token}
            })
            .then(response => {
                this.post = response.data[0];
            })
            .catch(reason => {
                console.log(reason.data);
            });

        axios.get('http://127.0.0.1:8000/api/comments/' + this.$route.params.id,
            {
                headers: {'Authorization': 'Bearer ' + this.$store.state.token}
            })
            .then(response => {
                this.allComments = response.data;
            })
            .catch(reason => {
                console.log(reason.data);
            });
    },
    methods : {
        createComment() {
            axios.post('http://127.0.0.1:8000/api/comments',
                this.newComment,
                {
                    headers: {'Authorization': 'Bearer ' + this.$store.state.token}
                })
                .then(response => {

                    let newCreatedComment = {
                        id     : response.data.id,
                        comment: response.data.comment.comment,
                        user   : {
                            id  : this.$store.state.user.id,
                            name: this.$store.state.user.name
                        }
                    };
                    this.allComments.push(newCreatedComment);
                })
                .catch(reason => {
                    console.log(reason.data);
                });
        }
    },
    computed: {
        emptyCommentBox() {
            return this.newComment.comment === '';
        }
    }
}
</script>

<style scoped>
.comments {
    text-align: left;
}

.comment-text {
    display: inline-block;
    padding-left: 10px;
}

h1, h3 {
    margin: 5px 0 0;
}
</style>
