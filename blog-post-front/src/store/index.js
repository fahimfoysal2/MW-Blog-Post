import Vue  from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state    : {
        token: '',
        user : {
            id  : '',
            name: '',
        },
    },
    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        setUsr(state, user){
            state.user.id = user.id;
            state.user.name = user.name;
        }
    },
    actions  : {
        login({commit}, data) {
            axios.post('http://127.0.0.1:8000/api/login', data)
                .then(response => {
                    console.log(response.data);
                    commit("setToken", response.data.token);
                    commit("setUsr", response.data.user);
                })
                .catch(reason => {
                    console.log(reason.data);
                })
        },
        register(data) {
            console.log("refister");
        }
    },
    modules  : {}
})
