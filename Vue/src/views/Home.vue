<template>
<div>
    <div class="w-screen h-[70vh] bg-cyan-600" >
        <div class="flex justify-start px-15 place-items-center h-full" v-if="display">
            <div>
                <p  class="font-bold text-4xl">{{display.title}}</p>
                <div class="px-5">
                    <p class="border-l-4 px-3 ">{{ display.note }}</p>
                </div>
                <p class="font-bold">{{ display.description }} </p>
                <button class="bg-pink-500   font-bold justify-center align-middle place-items-center mx-auto hover:bg-pink-600 px-3 py-2  rounded-lg shadow-xl shadow-black">
                    <!-- <router-link :to="{name: display.link }" class="flex place-items-center">
                        GET  STARTED
                    </router-link> -->
                    <a :href=display.link>GET STARTED</a>
                </button>
            </div>
            <div class="flex justify-center place-items-center mx-auto hidden sm:block">
                <!-- <img src="/images/download.jpg" class="w-[300px] max-h-[300px] shadow-xl shadow-blue-800 rounded-full" alt=""> -->
                <img :src=display.image class="w-[300px] max-h-[300px] shadow-xl shadow-blue-800 rounded-full" alt="">
            </div>
            
        </div>




        <!-- <img src="./../../public/images/car.jpg" class=" w-screen h-[100%] object-contain" alt="">
        <button class="relative -top-20 bg-pink-500 flex  font-bold justify-center align-middle place-items-center mx-auto hover:bg-pink-600 px-3 py-2  rounded-lg shadow-xl shadow-black">
                    <router-link :to="{name:'Home'}" class="flex place-items-center">
                        GET  STARTED
                        <ArrowRightIcon class="w-7"/>
                    </router-link>
        </button> -->
    </div>
    <!-- <div class="flex justify-around bg-slate-100 py-3">
        <div class="sm:py-2 py-1 rounded-xl shadow bg-slate-300 hover:bg-cyan-400 font-bold border-dashed border sm:px-4 px-1">SHOPPING</div>
        <div class="sm:py-2 py-1 rounded-xl shadow bg-slate-300 hover:bg-cyan-400 font-bold border-dashed border sm:px-4 px-1">TRANSPORT</div>
        <div class="sm:py-2 py-1 rounded-xl shadow bg-slate-300 hover:bg-cyan-400 font-bold border-dashed border sm:px-4 px-1">PACKAGE DELIVERY</div>
    </div> -->
    
    <div class="w-3/4 mx-auto  bg-gray-100 py-3 sm:block hidden">
        <div  class="flex justify-around">     
            <div class="w-[150px] h-fit bg-cyan-400 text-center pb-5 rounded-md ">
                <p class="text-[60px] font-bold">{{str.shopping}}</p>
                <p>Shopping trips</p>
            </div>
            <div class="sm:w-[150px] h-fit bg-cyan-400 text-center pb-5 rounded-md">
                <p class="text-[60px] font-bold">{{str.rides}}</p>
                <p>Transport Trips</p>
            </div>
            <div class="w-[150px] h-fit bg-cyan-400 text-center pb-5 rounded-md">
                <p class="text-[60px] font-bold">{{ str.packages }}</p>
                <p>Packages Delivered</p>
            </div>
        </div>
    </div>

    
    <div class="sm:w-3/4 sm:h-[200px] bg-cyan-200  text-sm py-5  md:mx-auto  shadow-xl sm:mx-5 rounded-tl-[50px] flex my-5">
        <div class="sm:w-3/4 text-center ">
            <p class="font-bold  text-xl">Shopping</p>
            <ul style="font-family: Comic Sans MS;">
                <li>~ Write a list at the comfort of your home or workplace</li>
                <li>~ Specify the destination location</li>
                <li>~ Select your favarite/available rider </li>
                <li>~ Make payments for your goods </li>
                <li>~ Delivery at your doorstep</li>
                <li class="font-bold">~ AS EASY AS THAT</li>
            </ul>
        </div>
        <img src="/images/download.jpg" class="mx-auto hidden sm:block " alt="">
    </div>
    <div class="sm:w-3/4 sm:h-fit bg-cyan-200  py-5    shadow-lg sm:mx-5 md:mx-auto rounded-tr-[50px] flex my-5">
        <img src="/images/customer.jpg" class="mx-auto w-[200px] sm:block hidden " alt="">
        <div class="sm:w-3/4 text-center">
            <p class="font-bold  text-xl">Transport</p>
            <ul style="font-family: Comic Sans MS;">
                <li>~ Specify your location</li>
                <li>~ Specify the destination location</li>
                <li>~ Specify the pick up time </li>
                <li>~ Select/request for your favarite/available rider </li>
                <li>~ Make payments </li>
                <li>~ Rider will be ready for you</li>
                <li class="font-bold">~ EASY RIGHT??</li>
            </ul>
        </div>
        
    </div>
    <div class="sm:w-3/4 sm:h-fit bg-cyan-200   py-5   shadow-lg sm:mx-5 md:mx-auto rounded-tl-[50px] flex my-5">
        <div class="sm:w-3/4 text-center">
            <p class="font-bold  text-xl">Package Delivery</p>
            <ul style="font-family: Comic Sans MS;">
                <li>~ Specify your location</li>
                <li>~ Specify the destination location</li>
                <li>~ Specify the pick up time </li>
                <li>~ Specify  the weight of the package </li>
                <li>~ Select/request for your favarite/available rider </li>
                <li>~ Make payments  & Rider will be ready for you</li>
                <li class="font-bold">~ WE MAKE WORK EASY</li>
            </ul>
        </div>
        <img src="/images/red.jpg" class="mx-auto hidden w-[200px] sm:block" alt="">
    </div>
</div>
</template>

<script setup>
import {onMounted, ref} from 'vue'
import store from '../store'
store.dispatch('userData')
let str = ref(store.state.user)
let display =  ref()
let x = 0;
setInterval(() => {
    display.value = data[x]
    // console.log(display.value)
    x++
    if(x>=3){
        x = 0;
    }
}, 5000);

const data = [
{
        title:'SHOPPING',
        note:'Quick and Easy',
        description:'Make the list with clear specification, we will get it at your doorstep',
        link:'Shopping',
        image:'/images/download.jpg',
        color:'blue'
    },
    {
        title:'TRANSPORT',
        note:'Fast and Convinient',
        description:'Request for transport services at the comfort of your house',
        link:'Transport',
        image:'/images/customer.jpg',
        color:'green'

    },
    {
        title:'PACKAGE DELIVERY',
        note:'Safe and OnTime',
        description:'Specify  the destination and the time, we delivery it quick',
        link:'PackageDelivery',
        image:'/images/red.jpg',
        color:'purple'

    }
]

</script>

<style>

</style>