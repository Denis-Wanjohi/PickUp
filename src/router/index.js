
import { createRouter,createWebHistory } from 'vue-router';
import store from '../store';
import DashBoard from '../views/DashBoard.vue'
import Home from '../views/Home.vue'

const routes = [ 
    {
        path:'/',
        name:'DashbBoard',
        component:DashBoard
    },
    {
        path:'/home',
        name:'Home',
        component:Home
    },
    {
        path:'/shopping',
        name:'Shopping',
        component:Home
    },
    {
        path:'/transport',
        name:'Transport',
        component:Home
    },
    {
        path:'/packageDelivery',
        name:'PackageDelivery',
        component:Home
    },
    
]
const router  = createRouter({
    history: createWebHistory(),
    routes
})

export default router