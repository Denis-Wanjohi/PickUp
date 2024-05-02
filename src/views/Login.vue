<template>
    <div class="flex justify-center w-screen h-screen place-items-center ">
        <div class="sm:w-1/2 w-full sm:p-0 px-2  shadow-xl bg-cyan-100 rounded-sm">
            <div class="text-center">
                <p class="font-bold text-3xl">Login to your account</p>
                <p class="text-sm">Dont have an account?
                     <router-link :to="{name:'Register'}" class="text-blue-600 hover:font-bold">Register</router-link>
                </p>
            </div>
            <form class="pt-5" @submit.prevent="userLogin">
                <div class="flex justify-center">
                    <input type="email" placeholder="email@example.com" required v-model="user.email" class="w-3/4 rounded-t-xl border  " >
                </div>
                <div class="flex justify-center">
                    <input type="password" placeholder="password" required v-model="user.password" class="w-3/4 rounded-b-xl border  " >
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
import store from '../store'
const router  = useRouter()

const user = {
    email:'',
    password:''
}

function userLogin(){
    store.dispatch('login',user)
        .then(()=>{
            console.log( store.state.destinations.names )
            if( store.state.destinations.names[0] !== 'Login'){
                router.push({name:store.state.destinations.names[0]} )
            }else{
                router.push({name:'Dashboard'})
            }
        })
}

</script>

<style>

</style>