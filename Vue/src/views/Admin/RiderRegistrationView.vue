<template>
    <div>
        <div>RIDER REGISTRATION</div>
        <form @submit.prevent="register" class="h-screen flex justify-center align-middle">
            <div class="surface-card p-4 shadow-2 border-round w-1/4 border-white border-2 rounded-md  m-auto">
            <div class="text-center mb-5">
                <!-- <img src="/demo/images/blocks/logos/hyper.svg" alt="Image" height="50" class="mb-3"> -->
                <div class="text-900 text-3xl font-medium mb-3">Welcome</div>
                <!-- <span class="text-600 font-medium line-height-3">Already have an account?</span> -->
                <!-- <router-link to="/login" class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Login</router-link> -->
            </div>

            <div>
                <label for="firstname" class="block text-900 font-medium mb-2">First Name</label>
                <InputText id="firstname" type="text" v-model="rider.firtsName" required placeholder="first name" class="w-full mb-3" />

                <label for="lastname" class="block text-900 font-medium mb-2">Last Name</label>
                <InputText id="lastname" type="text" v-model="rider.lastName" required placeholder="last name" class="w-full mb-3" />
                
                <label for="username" class="block text-900 font-medium mb-2">Username</label>
                <InputText id="username" type="text" v-model="rider.userName" required placeholder="username" class="w-full mb-3" />

                <label for="email1" class="block text-900 font-medium mb-2">Email</label>
                <InputText id="email1" type="text" v-model="rider.email" required placeholder="Email address" class="w-full mb-3" />

                <label for="phone" class="block text-900 font-medium mb-2">Phone Number</label>
                <InputText id="phone" type="text" v-model="rider.phone" required placeholder="Phone number" class="w-full mb-3" />

                <label for="age" class="block text-900 font-medium mb-2">Age</label>
                <InputText id="age" type="text" v-model="rider.age" required placeholder="Age" class="w-full mb-3" />

                <label for="bike" class="block text-900 font-medium mb-2">Bike</label>
                <InputText id="bike" type="text" v-model="rider.bike" required placeholder="Bike model" class="w-full mb-3" />

                <label for="station" class="block text-900 font-medium mb-2">Bike</label>
                <InputText id="station" type="text" v-model="rider.station" required placeholder="Station" class="w-full mb-3" />

                <label for="password" class="block text-900 font-medium mb-2">Password</label>
                <InputText id="password" type="password" v-model="rider.password" required placeholder="Password" class="w-full mb-3" />

                <Button label="Sign Up" icon="pi pi-user" class="w-full" type="submit"></Button>
            </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'
import   store from  '../../store/index'
import{ref} from 'vue'
const rider = {
    firtsName:'',
    lastName:'',
    email:'',
    phone:'',
    userName:'',
    age:'',
    bike:'',
    station:'',
}

function register(){
    store.dispatch('registerRider')
        .then(()=>{
            console.log('registerion done')
        })
        .catch((err)=>{
            console.log("err :"+ err)
        })
}
</script>