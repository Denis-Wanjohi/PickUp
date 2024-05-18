<template>
    <div class="w-full h-[50px] bg-cyan-700 flex justify-around">
        <div class="w-3/4 flex justify-center place-items-center font-bold text-3xl" style=" font-family: Perpetua Titling MT">
            <router-link :to="{name:'Home'}">PICKUP</router-link>
        </div>
        <div class="w-[40%] flex justify-around place-items-center hidden sm:block">
            <!-- <div class=" px-2 p-1 rounded-lg hover:bg-blue-900 hover:text-white">Quick Ride</div>
            <div class=" px-2 p-1 rounded-lg hover:bg-blue-900 hover:text-white">About us</div> -->
            <router-link class="bg-purple-500  text-white py-1 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'Shopping'}">Shopping</router-link>
            <router-link class="bg-purple-500  text-white py-1 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'Transport'}">Transport</router-link>
            <router-link class="bg-purple-500  text-white py-1 px-2 rounded-lg hover:bg-purple-800 cursor-pointer hover:text-black" :to="{name:'PackageDelivery'}">PackageDelivery</router-link>
        </div>
        <div  class="sm:hidden">
            <Bars3Icon @click="viewMenu" v-if="menuView === false"></Bars3Icon>
            <XMarkIcon @click="viewMenu" v-else></XMarkIcon>
        </div>
        
    </div>
    <div class="bg-slate-500 flex justify-end" v-if="menuView" >
        <div class="bg-slate-400 w-1/2  h-fit z-10 absolute rounded-md">
            <!-- <XMarkIcon  @click="viewMenu" class="w-5 rounded-full bg-orange-300 hover:bg-slate-500 z-10 absolute right-4"></XMarkIcon> -->
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
    </div>
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