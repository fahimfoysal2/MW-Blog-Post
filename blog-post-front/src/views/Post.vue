<template>
    <div class="post">
        <h3>Show One Post Data</h3>
        <div class="postData">
            Post with ID:{{ $route.params.id }} to show here
            <div class="post-content">
                <p>{{ post.content }}</p>
            </div>
        </div>
        <hr>
        <div class="comments">
            <h5>Comments</h5>
            <div v-for="comment in post.comments" class="comment">
                <a href="#">{{ comment.user.name }}</a>
                <p class="comment-text">{{ comment.text }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    data() {
        return {
            post: {
                id      : 1,
                title   : "Post Title",
                content : "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut, corporis delectus deleniti earum eius est laboriosam laudantium modi molestias nisi obcaecati provident quae, quam quidem totam vitae voluptatibus!",
                author  : {
                    name: "Fahim Foysal",
                    id  : 1,
                },
                comments: [
                    {
                        id  : 1,
                        text: "Nice Post",
                        user: {
                            id  : 1,
                            name: "Fahim"
                        }
                    },
                    {
                        id  : 2,
                        text: "Nice Post Again",
                        user: {
                            id  : 2,
                            name: "Foysal"
                        }
                    }
                ]
            }
        }
    }
}
</script>

<style scoped>
    .comments{
        text-align: left;
    }
    .comment-text{
        display: inline-block;
        padding-left: 10px;
    }
</style>
