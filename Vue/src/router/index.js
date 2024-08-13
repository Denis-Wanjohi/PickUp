
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
        component:DashBoard,
        meta:{requireAuth:false}
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
            {  path:'/addRider',name:'RiderRegistration',component:RiderRegistration,meta:{requireAuth:true},}
        ]
    },
    {
        path:'/login',
        name:'Login',
        component:Login,
        meta:{requireAuth:false}
    },
    {
        path:'/register',
        name:'Register',
        component:Register,
        meta:{requireAuth:false}
    },
    {
        path:'/addRider',
        name:'RiderRegistration',
        component:RiderRegistration,
        meta:{requireAuth:true}
    }
    
    
]
const router  = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requireAuth && !sessionStorage.getItem('Auth')) {
      next({ path: '/login' })
    } else if ((to.path === '/login' || to.path === '/register') && sessionStorage.getItem('Auth')) {
      next({ path: '/dashboard' })
    } else if (to.path === '/' && sessionStorage.getItem('Auth')) {
      next({ path: '/dashboard' })
    } else {
      next()
    }
  })
export default router