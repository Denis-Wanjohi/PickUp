 border<template>
    <!-- <div class="flex justify-center w-screen h-screen place-items-center ">
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
    </div> -->
    <TopNav></TopNav>
    <form @submit.prevent="register" class="h-screen flex justify-center align-middle">
    <div class="surface-card p-4 shadow-2 border-round w-1/4 border-white border-2 rounded-md  m-auto">
      <div class="text-center mb-5">
          <!-- <img src="/demo/images/blocks/logos/hyper.svg" alt="Image" height="50" class="mb-3"> -->
          <div class="text-900 text-3xl font-medium mb-3">Welcome</div>
          <span class="text-600 font-medium line-height-3">Already have an account?</span>
          <router-link to="/login" class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Login</router-link>
      </div>

      <div>
        <label for="names" class="block text-900 font-medium mb-2">Full Names</label>
        <InputText id="names" type="text" v-model="user.email" required placeholder="Full names" class="w-full mb-3" />

        <label for="email1" class="block text-900 font-medium mb-2">Email</label>
        <InputText id="email1" type="text" v-model="user.email" required placeholder="Email address" class="w-full mb-3" />

        <label for="phone" class="block text-900 font-medium mb-2">Phone Number</label>
        <InputText id="phone" type="text" v-model="user.phoneNumber" required placeholder="Phone number" class="w-full mb-3" />

        <label for="password" class="block text-900 font-medium mb-2">Password</label>
        <InputText id="password" type="password" v-model="user.password" required placeholder="Password" class="w-full mb-3" />

        <label for="passwordConfirmation" class="block text-900 font-medium mb-2">Confirm Password</label>
        <InputText id="passwordConfirmation" type="password" required v-model="user.password_confirmation" placeholder="Confirm password" class="w-full mb-3" />



          <Button label="Sign Up" icon="pi pi-user" class="w-full" type="submit"></Button>
      </div>
    </div>
  </form>
</template>

<script setup>
import store from '../store'
import { useRouter } from 'vue-router';
import { XMarkIcon } from '@heroicons/vue/24/outline';
import { ref } from 'vue';
import { vMaska } from "maska/vue"
import TopNav from './HomePage/TopNav.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button';
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