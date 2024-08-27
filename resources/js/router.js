import { createWebHistory, createRouter } from 'vue-router';




import index from './components/Index.vue';


const routes = [
    { path: '/login', component: function () { return import('./components/auth/Login.vue') }, name: 'login' },
    { path: '/registration', component: function () { return import('./components/auth/Registration.vue') }, name: 'registration' },
    { path: '/', component: index, name: 'index', redirect: { name: 'home' } },
    { path: '/home', component: function () { return import('./components/home/Home.vue') }, name: 'home' },
    { path: '/offers', component: function () { return import('./components/offer/Index.vue') }, name: 'offer.index' },
    { path: '/offers/create', component: function () { return import('./components/offer/Create.vue') }, name: 'offer.create' },
    { path: '/offers/:id', component: function () { return import('./components/offer/Show.vue') }, name: 'offer.show' },
    { path: '/offers/:id/edit', component: function () { return import('./components/offer/Edit.vue') }, name: 'offer.edit' },
    { path: '/webmaster/subscriptions', component: function () { return import('./components/webmaster/Subscrption.vue') }, name: 'webmaster.subscriptions' },
    { path: '/webmaster/wallet', component: function () { return import('./components/webmaster/Wallet.vue') }, name: 'webmaster.wallet' },
    { path: '/webmaster/statistics', component: function () { return import('./components/webmaster/Statistics.vue') }, name: 'webmaster.statistics' },
    { path: '/webmaster/profile', component: function () { return import('./components/webmaster/Profile.vue') }, name: 'webmaster.profile' },
    { path: '/advertiser/profile', component: function () { return import('./components/advertiser/Profile.vue') }, name: 'advertiser.profile' },
    { path: '/advertiser/wallet', component: function () { return import('./components/advertiser/Wallet.vue') }, name: 'advertiser.wallet' },
    { path: '/advertiser/statistics', component: function () { return import('./components/advertiser/Statistics.vue') }, name: 'advertiser.statistics' },
    { path: '/advertiser/offers', component: function () { return import('./components/advertiser/Offers.vue') }, name: 'advertiser.offers' },
    { path: '/administrator/profile', component: function () { return import('./components/administrator/Profile.vue') }, name: 'administrator.profile' },
    { path: '/administrator/wallet', component: function () { return import('./components/administrator/Wallet.vue') }, name: 'administrator.wallet' },
    { path: '/administrator/users', component: function () { return import('./components/administrator/Users.vue') }, name: 'administrator.users' },
    { path: '/administrator/statistics', component: function () { return import('./components/administrator/Statistics.vue') }, name: 'administrator.statistics' },


]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router