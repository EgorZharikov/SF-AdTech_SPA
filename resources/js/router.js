import { createWebHistory, createRouter } from 'vue-router';




import index from './components/Index.vue';


const routes = [
    { path: '/login', component: function () { return import('./components/auth/Login.vue') }, name: 'login' },
    { path: '/registration', component: function () { return import('./components/auth/Registration.vue') }, name: 'registration' },
    { path: '/', component: index, name: 'index' },
    { path: '/home', component: function () { return import('./components/home/Home.vue') }, name: 'home' },
    { path: '/offers/create', component: function () { return import('./components/offer/Create.vue') }, name: 'offer.create' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router