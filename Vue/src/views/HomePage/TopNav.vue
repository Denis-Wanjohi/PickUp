<template>
   
   <div class="h-20 z-3 bg-amber-700 w-screen">
        <div  class="flex justify-between align-middle h-full">
            <div class="w-1/4 flex justify-center m-auto text-4xl font-extrabold ">KiriRide</div>
            <div class="w-1/2 flex justify-evenly align-center h-full   my-auto" v-if="$route.path === '/'">
                <router-link to="/transport">
                    <div class="px-3 py-2 text-xl rounded-md hover:text-xl hover:text-white hover:bg-slate-600 cursor-pointer border border-black">Quick Ride</div>
                </router-link>
                <div class="px-3 py-2 text-xl rounded-md hover:text-xl hover:text-white hover:bg-slate-600 cursor-pointer border border-black">About us</div>
                <router-link to="/login">
                    <div class="px-3 py-2 text-xl rounded-md hover:text-xl hover:text-white hover:bg-slate-600 cursor-pointer border border-black">Login</div>
                </router-link>
            </div>
        </div>
   </div>


    
</template>
<script setup>

</script>