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
          <InputText id="email1" type="email" v-model="user.email" placeholder="email@gmail.com" required class="w-full mb-3" />
            <p class="text-center text-red-600 text-sm font-sans">{{ login_error }}</p>
          <label for="password" class="block text-900 font-medium mb-2">Password</label>
          <InputText id="password" type="password" v-model="user.password" placeholder="password" required class="w-full mb-3" />

          <div class="flex align-items-center justify-content-between mb-6">
              <!-- <div class="flex align-items-center">
                  <Checkbox id="rememberme1" :binary="true" v-model="checked" class="mr-2"></Checkbox>
                  <label for="rememberme1" class="text-900">Remember me</label>
              </div> -->
              <a class="font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer">Forgot password?</a>
          </div>
          <Button v-if="!submitted" label="Sign In" icon="pi pi-user" class="w-full" type="submit"></Button>
          <div v-else class="w-full rounded-lg py-1 flex justify-center" style="background-color: #10b981;">
            <VProgressCircular color="white" indeterminate />
          </div>
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
const submitted = ref(false)
const user = {
    email:'',
    password:''
}
const login = ref(false)
const login_error = ref()
const errorTimer = ref()

function userLogin(){
    console.log(user)
    submitted.value = true
    login.value = true
    store.dispatch('login',user)
        .then((data)=>{
            console.log(data)
            if(data == 'invalid credentials'){
                user.email = ''
                user.password = ''
                submitted.value = false
                login_error.value = "Credentials doesn't match our records"
                setTimeout(()=>{
                    login_error.value = null
                },5000)
            }
            if(data == 'pass'){
                router.push({name:'Dashboard'})
            }
        })
        .catch((err)=>{
            console.log("error seen")
            console.log(err)
            setTimeout(()=>{
                login_error.value = ''
            },5000)
            login.value = false
            submitted.value = false
            // login_error.value = err.response.data.error
        })
}
function closeError(ev){
    ev.preventDefault();
    error.value = null
}

</script>

<style>

</style>