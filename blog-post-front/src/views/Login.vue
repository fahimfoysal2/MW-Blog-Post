<template>
    <div class="login">

        <h3>Login Page</h3>
        <form v-on:submit.prevent>
            <input v-model.trim="email" type="email" name="email" id="email" placeholder="Email"> <br> <br>
            <input v-model="password" type="password" name="password" id="pass" placeholder="Password"> <br> <br>

            <div v-if="newUser">
                <input v-model="name" type="text" name="name" id="name" placeholder="User Name"> <br> <br>
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
            name    : '',
            email   : '',
            password: '',
        }
    },
    methods : {
        authenticate() {
            console.log('Authentication Process');
            axios.post('http://127.0.0.1:8000/' + this.authRoute, [this.email, this.password])
                .then(response => {
                    console.log(response.data);
                })
                .catch(reason => {
                    console.log(reason.data);
                })
        }
    },
    computed: {
        authRoute() {
            return this.newUser ? 'login' : 'register';
        }
    },
}
</script>

<style scoped>

</style>
