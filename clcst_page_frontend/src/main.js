import { createApp } from 'vue'
import router from './routes'

import './axios'
import './style.css'
import App from './App.vue'

/* import the bootstrap */
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap  from 'bootstrap/dist/js/bootstrap.bundle.js'

const app = createApp(App);
app.use(router,bootstrap)
app.mount('#app')