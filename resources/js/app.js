import './bootstrap';

import { createApp } from 'vue';
import App from "@/Layouts/AppLayout.vue";
import router from '@/Router';

createApp(App)
    .use(router)
    .mount('#app');
