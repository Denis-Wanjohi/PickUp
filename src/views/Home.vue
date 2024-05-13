<template>
<div>
    <div class="w-screen h-[70vh] border-b bg-slate-500">
        <img src="./../../public/images/car.jpg" class=" w-screen h-[100%] object-contain" alt="">
        <button class="relative -top-20 bg-pink-500 flex  font-bold justify-center align-middle place-items-center mx-auto hover:bg-pink-600 px-3 py-2  rounded-lg shadow-xl shadow-black">
                    <router-link :to="{name:'Home'}" class="flex place-items-center">
                        GET  STARTED
                        <ArrowRightIcon class="w-7"/>
                    </router-link>
        </button>
    </div>
    <div class="flex justify-around bg-slate-100 py-3">
        <div class="py-2 rounded-xl shadow bg-slate-300 hover:bg-cyan-400 font-bold border-dashed border px-4">SHOPPING</div>
        <div class="py-2 rounded-xl shadow bg-slate-300 hover:bg-cyan-400 font-bold border-dashed border px-4">TRANSPORT</div>
        <div class="py-2 rounded-xl shadow bg-slate-300 hover:bg-cyan-400 font-bold border-dashed border px-4">PACKAGE DELIVERY</div>
    </div>
    <div class="flex justify-around bg-slate-100 py-3">
        <div class="w-[150px] h-fit bg-gray-700 text-center pb-5 rounded-md">
            <p class="text-[60px] font-bold">0</p>
            <p>shoppings</p>
        </div>
        <div class="w-[150px] h-fit bg-gray-700 text-center pb-5 rounded-md">
            <p class="text-[60px] font-bold">0</p>
            <p>Transport Trips</p>
        </div>
        <div class="w-[150px] h-fit bg-gray-700 text-center pb-5 rounded-md">
            <p class="text-[60px] font-bold">0</p>
            <p>Packages Delivered</p>
        </div>
    </div>
    <div class="w-3/4 h-[200px] bg-green-300  shadow-lg mx-auto rounded-tl-[50px] flex my-5">
        <div class="w-3/4 text-center">
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
        <img src="/images/car.jpg" alt="">
    </div>
    <div class="w-3/4 h-[200px] bg-green-300  shadow-lg mx-auto rounded-tr-[50px] flex my-5">
        <img src="/images/car.jpg" alt="">
        <div class="w-3/4 text-center">
            <p class="font-bold  text-xl">Transport</p>
            <ul style="font-family: Comic Sans MS;">
                <li>~ Write a list at the comfort of your home or workplace</li>
                <li>~ Specify the destination location</li>
                <li>~ Select your favarite/available rider </li>
                <li>~ Make payments for your goods </li>
                <li>~ Delivery at your doorstep</li>
                <li class="font-bold">~ AS EASY AS THAT</li>
            </ul>
        </div>
        
    </div>
    <div class="w-3/4 h-[200px] bg-green-300  shadow-lg mx-auto rounded-tl-[50px] flex my-5">
        <div class="w-3/4 text-center">
            <p class="font-bold  text-xl">Package Delivery</p>
            <ul style="font-family: Comic Sans MS;">
                <li>~ Write a list at the comfort of your home or workplace</li>
                <li>~ Specify the destination location</li>
                <li>~ Select your favarite/available rider </li>
                <li>~ Make payments for your goods </li>
                <li>~ Delivery at your doorstep</li>
                <li class="font-bold">~ AS EASY AS THAT</li>
            </ul>
        </div>
        <img src="/images/car.jpg" alt="">
    </div>
</div>
</template>

<script setup>
import {ref} from 'vue'
import store from '../store'

let str = ref(store.state.user)

</script>

<style>

</style>