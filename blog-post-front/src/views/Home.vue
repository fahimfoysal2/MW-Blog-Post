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
                    details: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusamus aut, corporis delectus deleniti earum eius est laboriosam laudantium modi molestias nisi obcaecati provident quae, quam quidem totam vitae voluptatibus!",
                    user   : {
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
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/posts',
            {
                headers: {'Authorization': 'Bearer ' + this.$store.state.token}
            })
            .then(response => {
                console.log("received");
                this.posts = response.data;
            })
            .catch(reason => {
                console.log(reason.data);
            });
    }
}
</script>
