<template>
    <div class="w-full h-[60px] bg-cyan-700 flex justify-around">
        <div class="w-3/4 flex justify-center place-items-center font-bold text-3xl" style=" font-family: comic sans ms">
            <router-link :to="{name:'Home'}">KiriRide</router-link>
        </div>
        <div class="w-fit sm:flex px-5 justify-around place-items-center space-x-10 sm:block hidden">
            <div>
                <!-- <router-link class="bg-purple-500  text-white py-2 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'Shopping'}">Shopping</router-link>
                <router-link to="shopping">Shopping</router-link> -->
                <a href="shopping" class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black">Shopping</a>
            </div>
            <div>
                <!-- <router-link class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black" :to="{name:'Transport'}">Transport</router-link> -->
                 <a href="transport" class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black">Transport</a>
            </div>
            <div>
                <!-- <router-link class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black" :to="{name:'PackageDelivery'}">PackageDelivery</router-link>
                <router-link to="shopping">hello</router-link> -->
                <a href="packageDelivery" class="bg-blue-500  text-white py-2 px-2 rounded-lg hover:bg-blue-800 cursor-pointer hover:text-black">Delivery</a>
            </div>
        </div>
        <div  class="grid place-content-center text-white sm:hidden">
            <svg v-if="menuView === false" @click="viewMenu" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="white" d="M19 17H5c-1.103 0-2 .897-2 2s.897 2 2 2h14c1.103 0 2-.897 2-2s-.897-2-2-2m0-7H5c-1.103 0-2 .897-2 2s.897 2 2 2h14c1.103 0 2-.897 2-2s-.897-2-2-2m0-7H5c-1.103 0-2 .897-2 2s.897 2 2 2h14c1.103 0 2-.897 2-2s-.897-2-2-2"/></svg>
            <svg v-else @click="viewMenu" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="white" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12z"/></svg>
        </div>
        
    </div>
    <!-- <div class="bg-slate-500 flex justify-end sm:block inset-0" v-if="menuView" >
        <div class="bg-slate-400 w-1/2  h-fit z-10 absolute rounded-md">
            <div class="text-center space-y-5 py-5">
                <div class="hover:bg-slate-800 hover:text-white">
                    <router-link @click="viewMenu" :to="{name:'Shopping'}">Shopping</router-link>
                </div>
                <div class="hover:bg-slate-800 hover:text-white">
                    <router-link @click="viewMenu" :to="{name:'Transport'}">Transport</router-link>
                </div>
                <div class="hover:bg-slate-800 hover:text-white">
                    <router-link @click="viewMenu" :to="{name:'PackageDelivery'}">Package Delivery</router-link>
                </div>
            </div>
        </div>
    </div> -->


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
import { Bars3Icon,XMarkIcon } from '@heroicons/vue/24/outline';
import { VSelect } from 'vuetify/lib/components/index.mjs';
import store from '../store'
import route from  '../router'

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