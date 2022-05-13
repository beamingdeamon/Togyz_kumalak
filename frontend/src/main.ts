import { createApp } from "vue";
import App from "./App.vue";
import axios, { AxiosInstance } from 'axios'
import VueAxios from 'vue-axios'

const apiClient: AxiosInstance = axios.create({
    withCredentials: true,
    baseURL: 'http://localhost:8000/api',
    headers: {'Authorization': `bearer ${localStorage.getItem('token')}`}
})

const app = createApp(App)
app.mount("#app");
