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
        }
    ]
})

export default router