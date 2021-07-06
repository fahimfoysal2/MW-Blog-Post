<template>
    <div class="login">
        <h3>Login Page</h3>
        <form v-on:submit.prevent="authenticate">
            <input v-model.trim="email" type="email" name="email" id="email" placeholder="Email"> <br> <br>
            <input v-model="password" type="password" name="password" id="pass" placeholder="Password"> <br> <br>

            <div v-if="newUser">
                <input v-model="name" type="text" name="name" id="name" placeholder="User Name" value="makeid"> <br>
                <br>
                <button @click="authenticate" :disabled="emptyForm">Register</button>
                or, <a href="#" @click="newUser = false">Login</a>
            </div>

            <div v-else>
                <button type="submit" :disabled="emptyForm">Login</button>
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
            name    : '',
            email   : '',
            password: '',
        }
    },
    methods : {
        authenticate() {
            this.$store.dispatch(this.authRoute, {email: this.email, password: this.password});
        }
    },
    computed: {
        authRoute() {
            return this.newUser ? 'register' : 'login';
        },
        emptyForm() {
            return (this.email === '' || this.password === '')
        },
    },
}
</script>

<style scoped>

</style>
