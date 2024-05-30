<template>
    <div class="w-full h-[50px] bg-cyan-700 flex justify-around">
        <div class="w-3/4 flex justify-center place-items-center font-bold text-3xl" style=" font-family: Perpetua Titling MT">
            <router-link :to="{name:'Home'}">PICKUP</router-link>
        </div>
        <div class="w-fit sm:flex px-5 justify-around place-items-center space-x-10 sm:block hidden">
            <div>
                <router-link class="bg-purple-500  text-white py-2 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'Shopping'}">Shopping</router-link>
            </div>
            <div>
                <router-link class="bg-purple-500  text-white py-2 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'Transport'}">Transport</router-link>
            </div>
            <div>
                <router-link class="bg-purple-500  text-white py-2 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'PackageDelivery'}">PackageDelivery</router-link>
            </div>
        </div>
        <div  class="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" ><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path></svg>
            <Bars3Icon @click="viewMenu" v-if="menuView === false"></Bars3Icon>
            <XMarkIcon @click="viewMenu" v-else></XMarkIcon>
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
    <router-view></router-view>
</template>
<script setup>
import {ref} from 'vue'
import { Bars3Icon,XMarkIcon } from '@heroicons/vue/24/outline';

const menuView = ref(false)

function viewMenu(){
    menuView.value = !menuView.value
}
</script>