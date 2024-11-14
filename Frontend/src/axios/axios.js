import axios from  "axios"
import store from '../store'
const axiosClient = axios.create({
    baseURL:  'http://127.0.0.1:8000/api'
    // baseURL:  'https://b4a8-102-6-234-116.ngrok-free.app/api'
    
})

axiosClient.interceptors.request.use(config =>{
    config.headers.Authorization = `Bearer ${store.state.user.token}`
    config.headers['Content-Type'] = 'application/json'
    // config.headers['ngrok-skip-browser-warning'] = '69420'
    return config;
})

export default axiosClient;