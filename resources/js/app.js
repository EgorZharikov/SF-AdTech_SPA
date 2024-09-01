import './bootstrap';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import store from "./store"
import router from "./router";
import { createApp } from 'vue';
import index from './components/Index.vue';


createApp(index).use(VueSweetalert2).use(store).use(router).mount('#app');