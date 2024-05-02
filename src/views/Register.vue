 border<template>
    <div class="flex justify-center w-screen h-screen place-items-center ">
        <div class="sm:w-1/2 w-full sm:p-0 px-2 shadow-xl bg-cyan-100 rounded-sm">
            <div class="text-center">
                <p class="font-bold text-3xl">Create an  account</p>
                <p class="text-sm">Already have an account?
                     <router-link :to="{name:'Login'}" class="text-blue-600 hover:font-bold">Login</router-link>
                </p>
            </div>
            <form class="pt-5" @submit="register">
                <div class="flex justify-center">
                    <input type="text" placeholder="Full Names" required v-model="user.fullname" name="name" class="w-3/4 rounded-t-xl  border" >
                </div>
                <div class="flex justify-center">
                    <input type="email" placeholder="email@example.com" required v-model="user.email" class="w-3/4   border" >
                </div>
                <div class="flex justify-center">
                    <input type="tel" placeholder="+2547XXXXXXXX" required v-model="user.phoneNumber" class="w-3/4  border " >
                </div>
                <div class="flex justify-center">
                    <input type="password" placeholder="Password" required v-model="user.password" class="w-3/4 border" >
                </div>
                <div class="flex justify-center">
                    <input type="password" placeholder="Confirm password" required v-model="user.confirmedPassword" class="w-3/4 rounded-b-xl  border" >
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
const router  = useRouter()

const user = {
    fullname: '',
    email:'',
    phoneNumber:'',
    password:'',
    confirmedPassword:''
}

function register(){
    store.dispatch('register',user)
        .then(()=>{
            router.push({
                name:'Dashboard'
            })
        })
}
</script>

<style>

</style>