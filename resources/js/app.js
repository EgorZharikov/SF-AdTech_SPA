import './bootstrap';
import { createApp } from 'vue';
import store from "./store"
import router from "./router";
import VueCookies from "vue-cookies";

import index from './components/Index.vue';


createApp(index).use(VueCookies).use(store).use(router).mount('#app');