import Vue from 'vue'
import Router from 'vue-router'
import About from '../views/About.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import Home from "../components/Home.vue";
import VueSweetalert2 from 'vue-sweetalert2';
import AddTask from "../components/AddTask";
import LoginAdmin from "../components/LoginAdmin";
import Admin from "../components/Admin";
import AddFeedback from "../components/AddFeedback";
import ChangePass from "../components/ChangePass";
import LoginMainAdmin from "../components/LoginMainAdmin";
import mainAdmin from "../components/MainAdmin";

Vue.use(Router)
Vue.use(VueSweetalert2)


let router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },

        {
            path: '/changePass',
            name: 'changePass',
            component: ChangePass
        },

        {
            path: '/mainAdmin',
            name: 'mainAdmin',
            component: mainAdmin
        },

        {
            path: '/loginMainAdmin',
            name: 'loginMainAdmin',
            component: LoginMainAdmin
        },

        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/',
            name: 'about',
            component: About
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '/addTask',
            name: 'addTask',
            component: AddTask
        },
        {
            path: '/loginAdmin',
            name: 'loginAdmin',
            component: LoginAdmin
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin
        },
        {
            path: '/addFeedback',
            name: 'addFeedback',
            component: AddFeedback
        },
    ]
})

export default router