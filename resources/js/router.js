import { createApp } from 'vue';
import { createWebHistory, createRouter } from 'vue-router';



import login from './components/Login.vue'
import registration from './components/Registration.vue'
import index from './components/Index.vue';
import home from './components/Home.vue'

const routes = [
    { path: '/login', component: login, name: 'login' },
    { path: '/registration', component: registration, name: 'registration' },
    { path: '/', component: index, name: 'index' },
    { path: '/home', component: home, name: 'home' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router