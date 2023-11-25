//import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import axios from 'axios'


axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

//import Vuelidate from '@vuelidate/core'
//import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm'


const app = createApp(App)

app.use(createPinia())
app.use(router)
//app.use(Vuelidate)
//app.use(BootstrapVue)

app.config.productionTip = false
app.mount('#app')
