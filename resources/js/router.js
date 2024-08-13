import { createApp } from 'vue';
import { createWebHistory, createRouter } from 'vue-router';



import login from './components/Login.vue'
import registration from './components/Registration.vue'

const routes = [
    { path: '/login', component: login, name: 'login' },
    { path: '/registration', component: registration, name: 'registration' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router