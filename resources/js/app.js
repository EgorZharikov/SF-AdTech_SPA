import './bootstrap';
import { createApp } from 'vue';
import router from "./router";

import index from './components/Index.vue';


createApp(index).use(router).mount('#app');