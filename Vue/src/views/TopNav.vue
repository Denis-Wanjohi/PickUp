<template>
    <div class="w-full h-[50px]  bg-cyan-700 flex  justify-around ">
        <div class="w-3/4 flex justify-center place-items-center font-bold text-3xl">KiriRide</div>
        <div class="w-1/4 flex justify-around place-items-center">
            <router-link  :to="{name:'Transport'}" class="hidden sm:block  px-3 p-1 rounded-lg hover:bg-blue-900 bg-purple-700 hover:text-white hover:font-bold">Quick Ride</router-link  :to="{name:'Transport'}">
            <!-- <div class=" px-3 p-1 rounded-lg hover:bg-blue-900 bg-purple-700 hover:text-white hover:font-bold">About us</div> -->
            <router-link :to="{name:'Login'}" class="px-3 p-1 rounded-lg hover:bg-blue-900 bg-purple-700 hover:text-white hover:font-bold">Login</router-link >
            <router-link :to="{name:'Register'}" class="hidden sm:block  px-3 p-1 rounded-lg hover:bg-blue-900 bg-purple-700 hover:text-white hover:font-bold">Sign me up</router-link >
        </div>
    </div>
</template>
<script setup>

</script>