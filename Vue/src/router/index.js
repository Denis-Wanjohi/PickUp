
import { createRouter,createWebHistory } from 'vue-router';
import store from '../store';
import DashBoard from '../views/HomePage.vue'
import Shopping from '../views/Dashboard/Shopping.vue'
import ShoppingCheckout from '../views/Dashboard/ShoppingCheckout.vue'
import Transport from '../views/Dashboard/Transport.vue'
import PackageDelivery from '../views/Dashboard/PackageDelivery.vue'
import Home from '../views/Dashboard.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import HomeLayout from '../components/HomeLayout.vue';
import RiderRegistration from '../views/Admin/RiderRegistrationView.vue'

const routes = [ 
    {
        path:'/',
        name:'Home',
        component:DashBoard
    },
    {
        path:'/home',
        redirect:'/dashboard',
        name:'Dashboard',
        meta:{requireAuth:true},
        component:HomeLayout,
        children:[
            {  path:'/dashboard',name:'HomePage',component:Home , meta:{requireAuth:true},},
            {  path:'/shopping',name:'Shopping',component:Shopping , meta:{requireAuth:true},},
            {  path:'/checkout',name:'Checkout',component:ShoppingCheckout , meta:{requireAuth:true},},
            {  path:'/transport',name:'Transport',component:Transport, meta:{requireAuth:true},},
            {  path:'/packageDelivery',name:'PackageDelivery',component:PackageDelivery, meta:{requireAuth:true},},
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
    {
        path:'/addRider',
        name:'RiderRegistration',
        component:RiderRegistration,
    }
    
    
]
const router  = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach((to,from,next)=>{
    store.state.paths.destinations.push(to.name)
    if(to.meta.requireAuth  && store.state.user.token === null){
        // store.state.paths.destinations.push(to.name)
        next({name:'Login'})
        // store.state.paths.destinations.push(to.name)
    }else if((to.name == 'Login' || to.name == 'Register'  || to.name == 'DashbBoard') && store.state.user.token != null){
        next({name:'Dashboard'})
    }
    else if(to.meta.requireAuth  && store.state.user.token !== null){
        next(store.state.paths.destinations[1])
        store.state.paths.destinations = []
    }else{
            store.state.paths.destinations = []
            next()
    }
    
})
export default router