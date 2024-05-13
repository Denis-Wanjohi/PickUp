<template>
    <div class="w-full h-[50px] bg-cyan-700 flex justify-around">
        <div class="w-3/4 flex justify-center place-items-center font-bold text-3xl" style=" font-family: Perpetua Titling MT">PICKUP</div>
        <div class="w-1/4 flex justify-around place-items-center">
            <!-- <div class=" px-2 p-1 rounded-lg hover:bg-blue-900 hover:text-white">Quick Ride</div>
            <div class=" px-2 p-1 rounded-lg hover:bg-blue-900 hover:text-white">About us</div> -->
            <router-link :to="{name:'Shopping'}">Shopping</router-link>
            <router-link :to="{name:'Transport'}">Transport</router-link>
            <router-link :to="{name:'PackageDelivery'}">PackageDelivery</router-link>
        </div>
    </div>
    <router-view></router-view>
</template>
<script setup>

</script>