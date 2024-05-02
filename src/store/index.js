import {createStore} from "vuex"
import axiosClient from "../axios/axios";
const store = createStore({
    state:{
        paths:{
            destinations:[]
        },
        user:{
            data:{},
            token: null,
        },
        dashboard:{
            loading:false,
            data:{}
        },

        
    },
    getters:{},
    actions:{
        async register({},user){
            const {data} = await axiosClient.post('/register',user)
            commit('registeredUser')
            return data
        }
     },

    mutations:{
    
    },
    modules:{}
})


export default store;