<template>

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
        <InputText id="names" type="text" v-model="user.name" required placeholder="Full names" class="w-full mb-3" />

        <label for="email1" class="block text-900 font-medium mb-2">Email</label>
        <InputText id="email1" type="text" v-model="user.email" required placeholder="Email address" class="w-full mb-3" />

        <label for="phone" class="block text-900 font-medium mb-2">Phone Number</label>
        <InputText id="phone" type="text" v-model="user.phone" required placeholder="Phone number" class="w-full mb-3" />

        <label for="password" class="block text-900 font-medium mb-2">Password</label>
        <InputText id="password" type="password" v-model="user.password" required placeholder="Password" class="w-full mb-3" />

        <label for="passwordConfirmation" class="block text-900 font-medium mb-2">Confirm Password</label>
        <InputText id="passwordConfirmation" type="password" required v-model="user.password_confirmation" placeholder="Confirm password" class="w-full mb-3" />


        <div class="text-red text-sm" v-for="err in error">
            {{ err[0] }}
        </div>
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
const error = ref([])
const user = {
    name: '',
    email:'',
    phone:'',
    password:'',
    password_confirmation:''
}

function register(){
    store.dispatch('register',user)
        .then((data)=>{
            router.push({
                name:'Dashboard'
            })
        })
        .catch((err)=>{
            console.log(typeof(error.value))
            console.log(err.response.data.error)
            err.response.data.forEach(element => {
                error.value.push(element)
                console.log(el)
            });
            console.log(error.value)
            // error.value = err.response.data.errors
        })
}
function closeError(ev){
    ev.preventDefault();
    error.value = null
}
</script>

<style>

</style>