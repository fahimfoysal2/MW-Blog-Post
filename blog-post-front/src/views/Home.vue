<template>
    <div class="home">
        <create-post v-if="loggedIn"/>
        <Posts :posts="posts"/>
    </div>
</template>

<script>
// @ is an alias to /src
import Posts      from "@/components/Posts";
import CreatePost from "@/components/CreatePost";

export default {
    name      : 'Home',
    components: {
        CreatePost,
        Posts,
    },
    data() {
        return {
            posts: [
                {
                    id     : 1,
                    title  : "Post Title",
                    content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut, corporis delectus deleniti earum eius est laboriosam laudantium modi molestias nisi obcaecati provident quae, quam quidem totam vitae voluptatibus!",
                    author : {
                        name: "Fahim Foysal",
                        id  : 1,
                    },
                },
                {
                    id     : 2,
                    title  : "Post Title",
                    content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut, corporis delectus deleniti earum eius est laboriosam laudantium modi molestias nisi obcaecati provident quae, quam quidem totam vitae voluptatibus!",
                    author : {
                        name: "Fahim Foysal",
                        id  : 1,
                    },
                },
                {
                    id     : 3,
                    title  : "Post Title",
                    content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut, corporis delectus deleniti earum eius est laboriosam laudantium modi molestias nisi obcaecati provident quae, quam quidem totam vitae voluptatibus!",
                    author : {
                        name: "Fahim Foysal",
                        id  : 1,
                    },
                },
            ]
        }
    },
    computed: {
        loggedIn() {
            return this.$store.state.token;
        }
    }
}
</script>
