<template>
    <div class="flex justify-center w-screen h-screen place-items-center ">
        <div class="sm:w-1/2 w-full sm:p-0 px-2  grid-1 place-content-center shadow-xl bg-cyan-200 rounded-sm">
            <div class="text-center">
                <p class="font-bold text-3xl">Login to your account</p>
                <p class="text-sm">Don't have an account?
                     <router-link :to="{name:'Register'}" class="text-blue-600 hover:font-bold">Register</router-link>
                </p>
            </div>
            <form class="pt-5 space-y-[1px]" @submit.prevent="userLogin">
                <div class="flex justify-center">
                    <input type="email" placeholder="email@example.com" required v-model="user.email" class="w-3/4 rounded-t-xl border  " >
                </div>
                <div class="flex justify-center">
                    <input type="password" placeholder="password" required v-model="user.password" class="w-3/4 rounded-b-xl border  " >
                </div>
                <div v-if="error" class="text-center text-xs text-red-500 flex place-items-center justify-around w-3/4 mx-auto bg-red-200 rounded-sm mt-3">
                   <p> {{ error }}</p>
                   <XMarkIcon @click="closeError" class="w-4 hover:bg-red-600  bg-red-300 hover:text-white rounded-full"/>
                </div>
                <div class="w-full flex justify-center">
                    <button type="submit" class="w-3/4 py-2 rounded-md  bg-blue-600 hover:bg-blue-700  h my-4">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import {ref} from 'vue'
import { XMarkIcon } from '@heroicons/vue/24/outline';
import store from '../store'
const router  = useRouter()

const user = {
    email:'',
    password:''
}
const error = ref()
function userLogin(){
    store.dispatch('login',user)
        .then((data)=>{

            // console.log( store.state.destinations.names )
            // if( store.state.destinations.names[0] !== 'Login'){
                // router.push({name:store.state.destinations.names[0]} )
            // }else{
                alert()
                router.push({name:'Home'})
            // }
        })
        .catch((err)=>{
            
            error.value = err.response.data.error
        })
}
function closeError(ev){
    ev.preventDefault();
    error.value = null
}

</script>

<style>

</style>