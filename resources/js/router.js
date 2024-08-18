import { createWebHistory, createRouter } from 'vue-router';



import login from './components/auth/Login.vue';
import registration from './components/auth/Registration.vue';
import index from './components/Index.vue';
import home from './components/home/Home.vue';
import create from './components/offer/Create.vue'

const routes = [
    { path: '/login', component: login, name: 'login' },
    { path: '/registration', component: registration, name: 'registration' },
    { path: '/', component: index, name: 'index' },
    { path: '/home', component: home, name: 'home' },
    { path: '/offers/create', component: create, name: 'offer.create' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router