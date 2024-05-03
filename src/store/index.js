import {createStore} from "vuex"
import axiosClient from "../axios/axios";
const store = createStore({
    state:{
        paths:{
            destinations:[]
        },
        user:{
            data:{},
            token: sessionStorage.getItem('Main'),
        },
        dashboard:{
            loading:false,
            data:{}
        },

        
    },
    getters:{},
    actions:{
        async register({commit},user){
            const {data} = await axiosClient.post('/register',user)
            commit('registerUser')
            return data
        },
        async login({commit},user){
            const {data} = await axiosClient.post('/login',user)
            commit('loginUser')
            return data
        }
     },
    mutations:{
        registerUser:(state,user)=>{
            state.user.token = sessionStorage.setItem('Main','123')
        },
        loginUser:(state)=>{
            state.user.token = sessionStorage.setItem('Main','123')
        }
    },
    modules:{}
})


export default store;