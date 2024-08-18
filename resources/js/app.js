import './bootstrap';
import { createApp } from 'vue';
import store from "./store"
import router from "./router";

import index from './components/Index.vue';


createApp(index).use(store).use(router).mount('#app');