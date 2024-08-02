<template>
    <TopNav></TopNav>
  <form @submit.prevent="userLogin" class="h-screen flex justify-center align-middle">
    <div class="surface-card p-4 shadow-2 border-round w-1/4 border-white border-2 rounded-md  m-auto">
      <div class="text-center mb-5">
          <!-- <img src="/demo/images/blocks/logos/hyper.svg" alt="Image" height="50" class="mb-3"> -->
          <div class="text-900 text-3xl font-medium mb-3">Welcome Back</div>
          <span class="text-600 font-medium line-height-3">Don't have an account?</span>
          <router-link to="/register" class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Create today!</router-link> 
      </div>

      <div>
          <label for="email1" class="block text-900 font-medium mb-2">Email</label>
          <InputText id="email1" type="text" v-model="user.email" placeholder="Email address" class="w-full mb-3" />

          <label for="password" class="block text-900 font-medium mb-2">Password</label>
          <InputText id="password" type="password" v-model="user.password" placeholder="Password" class="w-full mb-3" />

          <div class="flex align-items-center justify-content-between mb-6">
              <!-- <div class="flex align-items-center">
                  <Checkbox id="rememberme1" :binary="true" v-model="checked" class="mr-2"></Checkbox>
                  <label for="rememberme1" class="text-900">Remember me</label>
              </div> -->
              <a class="font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer">Forgot password?</a>
          </div>

          <Button label="Sign In" icon="pi pi-user" class="w-full" type="submit"></Button>
      </div>
    </div>
  </form>

</template>

<script setup>
import { useRouter } from 'vue-router';
import {ref} from 'vue'
import { XMarkIcon } from '@heroicons/vue/24/outline';
import {  VProgressCircular } from 'vuetify/lib/components/index.mjs';
import store from '../store'
import TopNav from './HomePage/TopNav.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
// import InputText from 'primevue/inputtext'
const router  = useRouter()

const user = {
    email:'',
    password:''
}
const login = ref(false)
const error = ref()
const errorTimer = ref()

function userLogin(){
    login.value = true
    store.dispatch('login',user)
        .then((data)=>{

            // console.log( store.state.destinations.names )
            // if( store.state.destinations.names[0] !== 'Login'){
                // router.push({name:store.state.destinations.names[0]} )
            // }else{
                router.push({name:'Dashboard'})
            // }
        })
        .catch((err)=>{
            setTimeout(()=>{
                error.value = ''
            },3000)
            login.value = false
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