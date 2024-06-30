<template>
  <div class="w-screen h-screen   flex justify-center  place-items-center bg-[url('images/car.jpg')] "   >
        <div class="w-screen sm:w-[50%] h-[100vh] bg-slate-200 opacity-85   grid place-content-center text-center">
            <div class="border rounded px-2 py-5 my-5 font-bold text-3xl  shadow-emerald-300 shadow text-black text-left font-sans space-x-1 space-y-3 " >
                <!-- style="font-family:Bradley Hand ITC;" -->

                <p class="">WE DELIVER,</p>
                <p class="">SAVE ON YOUR TIME ON THE GO</p>
                <p class="">&</p>
                <p class="">CREATE TRUSTWORTHYNESS </p> 
                <p class="text-sm font-normal">
                    Get your shopping done and delivered at your doorstep fast and easy <br>
                    Transport Services and Package delivery Services
                </p>
                <button class="bg-pink-500 flex  text-xl font-bold justify-center align-middle place-items-center hover:bg-pink-600 px-3 py-2 my-3 rounded-lg shadow-xl shadow-black  transition delay-150 ease-in-out hover:translate-x-3">
                    <router-link :to="{name:'Home'}" class="flex place-items-center">
                        GET  STARTED
                        <ArrowRightIcon class="w-7"/>
                    </router-link>
                </button>
            </div>
            <!-- <div>
                <button class="bg-pink-500 flex  font-bold justify-center align-middle place-items-center mx-auto hover:bg-pink-600 px-3 py-2  rounded-lg shadow-xl shadow-black">
                    <router-link :to="{name:'Home'}" class="flex place-items-center">
                        GET  STARTED
                        <ArrowRightIcon class="w-7"/>
                    </router-link>
                </button>
            </div> -->
        </div>
        <div class="hidden sm:block w-[50%] h-[100vh] bg-slate-500 opacity-90 grid place-content-center text-center gap-3">
            <img :src="currentImage" class=" rounded-tl-[50px] rounded-br-[50px] px-5 max-h-[300px] min-h-[300px] mx-auto" alt="">
            <p class="font-mono animate-fade-in-down">{{currentDesc}}</p>
        </div>
  </div>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline'
import {ref} from 'vue'
const currentImage = ref('/images/groceries.jpg')
const currentDesc = ref("In a time fixed day??? w'll do the shopping")
const  images = [
    {
        image:'/images/shopping.jpg',
        desc:"In a time fixed day??? w'll do the shopping"
    },
    {
        image:'/images/customer.jpg',
        desc:"Late??? Just a press away"
    },
    {
        image:'/images/red.jpg',
        desc:"Get the package to the destination in few minutes"
    },
    {
        image:'/images/delivery.jpg',
        desc:"Get the package to the destination in few minutes"
    },
    {
        image:'/images/delivered.jpg',
        desc:"Get the package to the destination in few minutes"
    },
]
const color = ["red","green","black","white","red","green","black","white"]
let x = 0
const val = ref()
setInterval(()=>{
    currentImage.value  = images[x].image
    currentDesc.value  = images[x].desc
    x++
    val.value = color[x]
    if(x >= images.length){
        x = 0 
    }
},5000)
let y = '../../public/images/download.jpg'
</script>

<style>
    .backdrop{
        background-image: url('../../public/images/car.jpg');
        object-fit:cover;
        background-size: cover;
    }
</style>