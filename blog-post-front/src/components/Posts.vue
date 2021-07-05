<template>
    <div class="posts">
        <div v-for="post in posts" class="post">
            <h1>{{ post.title }}</h1>
            <small>
                <a href="#">
                    {{ post.author.name }}
                </a>
            </small>
            <div class="post-text">
                <p>
                    {{ post.content }}
                    <br>
                    <br>
                    <span class="read-more">
                        <router-link :to="`/post/${post.id}`">Read More</router-link>
                    </span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name : 'PostList',
    props: {
        posts: Array
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.posts {
    text-align: unset;
}

.post {
    border-bottom: 1px solid #2c3e50;
    padding: 0 15px;
}

.post:last-child {
    border: none;
}

.post-text {
    text-align: left;
}

h1, h3 {
    margin: 40px 0 0;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: inline-block;
    margin: 0 10px;
}

a {
    color: #42b983;
}
</style>
