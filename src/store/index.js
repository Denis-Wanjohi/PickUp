import {createStore} from "vuex"
import axiosClient from "../axios/axios";
const store = createStore({
    state:{
        user:{
            data:{},
            token: 123,
        },
        dashboard:{
            loading:false,
            data:{}
        },
        
    },
    getters:{},
    actions:{

     },

    mutations:{
    
    },
    modules:{}
})


export default store;