// Import createApp from Vue
import { createApp } from 'vue';

// Import component App
import App from './App.vue';

// Import router configuration
import router from './router';

// Create Vue application
const app = createApp(App);

// Use "router" in Vue with the "use" plugin
app.use(router);

// Mount the application to the DOM
app.mount('#app');