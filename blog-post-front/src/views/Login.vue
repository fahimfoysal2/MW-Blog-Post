<template>
    <div class="login">

        <h3>Login Page</h3>
        <form v-on:submit.prevent>
            <input v-model.trim="email" type="email" name="email" id="email" placeholder="Email"> <br> <br>
            <input v-model="password" type="password" name="password" id="pass" placeholder="Password"> <br> <br>

            <div v-if="newUser">
                <button @click="authenticate">Register</button>
                or, <a href="#" @click="newUser = false">Login</a>
            </div>

            <div v-else>
                <button @click="authenticate">Login</button>
                or, <a href="#" @click="newUser = true">Create Account</a>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            newUser : false,
            email   : '',
            password: '',
        }
    },
    methods: {
        authenticate() {
            console.log('Authentication Process');
        }
    },
}
</script>

<style scoped>

</style>
