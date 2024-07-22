 border<template>
    <div class="flex justify-center w-screen h-screen place-items-center ">
        <div class="sm:w-1/2 w-full sm:p-0 px-2 shadow-xl grid-1 place-content-center bg-cyan-200   rounded-sm space-y-[1px]">
            <div class="text-center">
                <p class="font-bold text-3xl">Create an  account</p>
                <p class="text-sm">Already have an account?
                     <router-link :to="{name:'Login'}" class="text-blue-600 hover:font-bold">Login</router-link>
                </p>
            </div>
            <form class="pt-5 space-y-[1px]" @submit.prevent="register">
                <div class="flex justify-center">
                    <input type="text" placeholder="Full Names" required v-model="user.fullname" name="name" class="w-3/4 rounded-t-xl  border" >
                </div>
                <div class="flex justify-center">
                    <input type="email" placeholder="email@example.com" required v-model="user.email" class="w-3/4   border" >
                </div>
                <div class="flex justify-center">
                    <input type="tel"  v-maska  data-maska="+254#########" placeholder="+2547XXXXXXXX" required v-model="user.phoneNumber" class="w-3/4  border " >
                </div>
                <div class="flex justify-center">
                    <input type="password" placeholder="Password" required v-model="user.password" class="w-3/4 border" >
                </div>
                <div class="flex justify-center">
                    <input type="password" placeholder="Confirm password" required v-model="user.password_confirmation" class="w-3/4 rounded-b-xl  border" >
                </div>
                <div v-if="error" class="text-center text-xs text-red-500 flex place-items-center justify-around w-3/4 mx-auto bg-red-200 rounded-sm mt-3">
                    <div>
                        <p  v-if="error.email"> {{ error.email[0]}}</p>
                        <p v-if="error.password"> {{ error.password[0]}}</p>  
                    </div>
                   <XMarkIcon @click="closeError" class="w-4 hover:bg-red-600  bg-red-300 hover:text-white rounded-full"/>
                </div>
                <div class="w-full flex justify-center">
                    <button type="submit" class="w-3/4 py-2 rounded-md  bg-blue-600 hover:bg-blue-700  h my-4">Register</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import store from '../store'
import { useRouter } from 'vue-router';
import { XMarkIcon } from '@heroicons/vue/24/outline';
import { ref } from 'vue';
import { vMaska } from "maska/vue"
const router  = useRouter()
const error = ref()
const user = {
    fullname: '',
    email:'',
    phoneNumber:'',
    password:'',
    password_confirmation:''
}

function register(){
    store.dispatch('register',user)
        .then((data)=>{
            router.push({
                name:'Home'
            })
        })
        .catch((err)=>{
            console.log(err)
            error.value = err.response.data.errors

            // if(err.response.data.errors.email){
            //     return
            // }else if(err.response.data.errors.password){
            //     error.value =  err.resonse.data.errors.password
            //     return
            // }
            // error.value  = err.response.data.errors.password
        })
}
function closeError(ev){
    ev.preventDefault();
    error.value = null
}
</script>

<style>

</style>