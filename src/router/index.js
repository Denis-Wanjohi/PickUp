
import { createRouter,createWebHistory } from 'vue-router';
import store from '../store';
import DashBoard from '../views/DashBoard.vue'
import Shopping from '../views/Dashboard/Shopping.vue'
import ShoppingCheckout from '../views/Dashboard/ShoppingCheckout.vue'
import Transport from '../views/Dashboard/Transport.vue'
import PackageDelivery from '../views/Dashboard/PackageDelivery.vue'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import HomeLayout from '../components/HomeLayout.vue';

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
    
    
]
const router  = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach((to,from,next)=>{
    if(to.meta.requireAuth  && store.state.user.token === null){
        next({name:'Login'})
    }else if((to.name == 'Login' || to.name == 'Register'  || to.name == 'DashbBoard') && store.state.user.token != null){
        next({name:'Home'})
    }
    else{
        next()
    }

})
export default router