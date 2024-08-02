<template>
    <div class="w-full h-[60px] bg-cyan-700 flex justify-around">
        <div class="w-3/4 flex justify-center place-items-center font-bold text-3xl" style=" font-family: comic sans ms">
            <router-link :to="{name:'Dashboard'}">KiriRide</router-link>
        </div>
        <div class="w-fit sm:flex px-5 justify-around place-items-center space-x-10 sm:block hidden">
            <div>
                <a href="shopping" class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black">Shopping</a>
            </div>
            <div>
                 <a href="transport" class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black">Transport</a>
            </div>
            <div>
                <a href="packageDelivery" class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black">Delivery</a>
            </div>
            <div>
                <Menu  class="cursor-pointer "></Menu>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 512 512">
                    <rect width="512" height="512" fill="none" />
                    <path fill="currentColor" d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38c-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6M432 480H80a31 31 0 0 1-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75c1.94 10.73-.68 21.34-7.18 29.11A31 31 0 0 1 432 480" />
                </svg> -->
            </div>
            
        </div>
        <div  class="grid place-content-center text-white sm:hidden">
            <svg v-if="menuView === false" @click="viewMenu" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="white" d="M19 17H5c-1.103 0-2 .897-2 2s.897 2 2 2h14c1.103 0 2-.897 2-2s-.897-2-2-2m0-7H5c-1.103 0-2 .897-2 2s.897 2 2 2h14c1.103 0 2-.897 2-2s-.897-2-2-2m0-7H5c-1.103 0-2 .897-2 2s.897 2 2 2h14c1.103 0 2-.897 2-2s-.897-2-2-2"/></svg>
            <svg v-else @click="viewMenu" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="white" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z"/></svg>
        </div>
        
    </div>



    <div>
        <div class="absolute top-[50px]  inset-0  bg-black"  v-if="menuView">
            <div class="w-full bg-white  py-4 my-5 text-center border-xl   rounded-3xl">
                <router-link @click="event=>(menuView = false)" to="shopping" class="py-5 font-bold text-xl w-full">SHOPPING</router-link>
            </div>
            <div class="w-full bg-white  py-4 my-5 text-center border-xl   rounded-3xl">
                <router-link   @click="event=>(menuView = false)" to="transport" class="py-5 font-bold text-xl w-full">TRANSPORT</router-link>
            </div>
            <div class="w-full bg-white  py-4 my-5 text-center border-xl   rounded-3xl">
                <router-link  @click="event=>(menuView = false)" to="packageDelivery" class="py-5 font-bold text-xl w-full">PACKAGE DELIVERY</router-link>
            </div>
            <div class="w-full bg-white  my-5 text-center border-xl   rounded-3xl">
                <div  @click="logout"  to="packageDelivery" class="py-5 font-bold text-xl w-full">LOGOUT</div>
            </div>
        </div>
    </div>
    <router-view></router-view>
</template>
<script setup>
import {ref} from 'vue'
import store from '../store'
import route from  '../router'
import Menu from './Menu.vue'
const menuView = ref(false)

function viewMenu(){
    menuView.value = !menuView.value
}
function logout(){
    menuView.value = false
    store.dispatch('logout',store.state.user)
        .then(()=>{
            route.push('/')
        })
        .catch((err)=>{
            console.log(err)
        })
}
</script>