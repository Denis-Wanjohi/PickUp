
import { createRouter,createWebHistory } from 'vue-router';
import store from '../store';
import DashBoard from '../views/DashBoard.vue'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import HomeLayout from '../components/HomeLayout.vue';
import { components } from 'vuetify/dist/vuetify-labs.js';

const routes = [ 
    {
        path:'/',
        name:'DashbBoard',
        component:DashBoard
    },
    {
        path:'/home',
        redirect:'/dashboard',
        name:'Home',
        meta:{requireAuth:true},
        component:HomeLayout,
        children:[
            {  path:'/dashboard',name:'HomePage',component:HomeLayout , meta:{requireAuth:true},},
            {  path:'/shopping',name:'Shopping',component:Home , meta:{requireAuth:true},},
            {  path:'/transport',name:'Transport',component:Home, meta:{requireAuth:true},},
            {  path:'/packageDelivery',name:'PackageDelivery',component:Home, meta:{requireAuth:true},},
        ]
    },
    {
        path:'/login',
        name:'Login',
        component:Login
    },
    {
        path:'/register',
        name:'Register',
        component:Register
    },
    
    
]
const router  = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach((to,from,next)=>{
    console.log(from.name)
    console.log(to.name)
    // store.state.paths.destinations.push(from.name)
    if(to.meta.requireAuth  && store.state.user.token === null){
        // console.log("destination was "+ store.state.destinations.names[0])
        next({name:'Login'})
    }else{
        next()
    }
})
export default router