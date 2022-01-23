import Vue from 'vue'
import App from './App.vue'
import router from './router/router'
import Axios from 'axios'
import Vuex from 'vuex'


import Chart from 'chart.js'
import Chartkick from 'vue-chartkick'
Vue.use(Chartkick.use(Chart));

Vue.prototype.$http = Axios;

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        name: "",
        surname: "",
        is_Auth: false,
        user_id: -1,
    },
    getters: {
        GET_ID: state => {
            return state.user_id;
        },
        GET_Name: state => {
            return state.name;
        },
        GET_Surname: state => {
            return state.surname;
        },
        GET_Is_Auth: state => {
            return state.is_Auth;
        },
    },
    mutations: {
        SET_ID: (state, value) => {
            state.user_id = value;
        },
        SET_Name: (state, value) => {
            state.name = value;
        },
        SET_Surname: (state, value) => {
            state.surname = value;
        },
        SET_Is_Auth: (state, value) => {
            state.is_Auth = value;
        },
    },
})


new Vue({
    router,
    store: store,
    render: h => h(App)
}).$mount('#app')