<template>
  <div class="w-screen h-[90vh] bg-cyan-200 flex justify-center  place-items-center">
        <div class="w-[40%] h-[70vh] bg-cyan-400  grid place-content-center text-center">
            <div class="border rounded px-2 py-5 my-5 font-bold text-4xl shadow-emerald-300 shadow"  style="font-family:Bradley Hand ITC;">
                <p class="">WE DELIVER,</p>
                <p class="">SAVE ON YOUR TIME</p>
                <p class="">&</p>
                <p class="">CREATE TRUSTWORTHYNESS </p> 
            </div>
            <div>
                <button class="bg-pink-500 flex  font-bold justify-center align-middle place-items-center mx-auto hover:bg-pink-600 px-3 py-2  rounded-lg shadow-xl shadow-black">
                    <router-link :to="{name:'Home'}" class="flex place-items-center">
                        GET  STARTED
                        <ArrowRightIcon class="w-7"/>
                    </router-link>
                </button>
            </div>
        </div>
        <div class="w-[40%] h-[70vh] bg-cyan-400 grid place-content-center text-center gap-3">
            <img :src="currentImage" class="rounded-tl-[50px] rounded-br-[50px] px-5 max-h-[300px] min-h-[300px] mx-auto" alt="">
            <p class="font-mono animate-fade-in-down">{{currentDesc}}</p>
        </div>
  </div>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline'
import {ref} from 'vue'
const currentImage = ref('/public/images/groceries.jpg')
const currentDesc = ref("In a time fixed day??? w'll do the shopping")
const  images = [
    {
        image:'/public/images/shopping.jpg',
        desc:"In a time fixed day??? w'll do the shopping"
    },
    {
        image:'/public/images/customer.jpg',
        desc:"Late??? Just a press away"
    },
    {
        image:'/public/images/red.jpg',
        desc:"Get the package to the destination in few minutes"
    },
    {
        image:'/public/images/delivery.jpg',
        desc:"Get the package to the destination in few minutes"
    },
    {
        image:'/public/images/delivered.jpg',
        desc:"Get the package to the destination in few minutes"
    },
]
let x = 0
setInterval(()=>{
    currentImage.value  = images[x].image
    currentDesc.value  = images[x].desc
    x++
    if(x >= images.length){
        x = 0 
    }
},5000)

</script>

<style>

</style>