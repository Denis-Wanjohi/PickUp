<template>
  <div class="inset-0 fixed bg-transparent w-screen h-screen flex justify-center place-items-center">
    <div class="w-3/4 h-[50%] bg-green-200 shadow-xl flex place-items-center justify-center">
      <div class="text-center">
        <!-- <div v-if="transport.confirmed === ''"> -->
          <div v-if="Package.destination === ''" class="text-center">
            <p>HELLO :)</p>
            <VProgressLinear  color="orange" indeterminate="1"></VProgressLinear>
          </div>
          <div v-else>
            <p>Hello am {{ rider.data.username }} i'll be your  rider for Today!</p>
            <p><span class="font-bold">Location:</span>{{ Package.location }}</p>
            <p><span class="font-bold">Destination:</span>{{ Package.destination }}</p>
            <p><span class="font-bold">PickUp Time:</span>{{ Package.time }}</p>
            <p><span class="font-bold">Weight:</span>{{ Package.weight === '50>' ? 'less than  50kg' : 'More than 50kgs' }}</p>
            <p><span class="font-bold">Price:</span>{{ rider.data.price }}</p>  
            <div class="flex justify-around">
              <button @click.prevent="emits('confirm')" class="bg-green-500 hover:bg-green-600 hover:cursor-pointer px-3 py-2 rounded-md">Confirm</button>
              <button @click.prevent="emits('decline')" class="bg-red-500 hover:bg-red-600 hover:cursor-pointer px-3 py-2 rounded-md">Decline</button>
            </div>
          </div>
        <!-- </div> -->
        <!-- <div v-else>
          
          <div v-if="transport.confirmed === true">
            <div class="font-bold">
              <HandThumbUpIcon class="w-30 text-orange rounded-full p-3 shadow-xl mx-auto"></HandThumbUpIcon>
              <p>You've just confirmed your ride</p>
              <p>Am on my way!!</p>
              <button class="w-1/2 bg-green rounded-md m-2" @click.prevent="emits('close',1)">oK</button>
            </div>
          </div>
          <div v-else>
            <div class="font-bold">
              <HandThumbDownIcon class="w-30 text-orange rounded-full p-3 shadow-xl mx-auto"></HandThumbDownIcon>
              <p>You just <span class="text-red">canceled</span> your trip</p>
              <p>Thank you stay safe!</p>
              <button class="w-1/2 bg-green rounded-md m-2" @click.prevent="emits('close',0)">Home</button>
            </div>
            
          </div>
        </div> -->
        
      </div>
    </div>
  </div>
</template>

<script setup>
import {HandThumbUpIcon,HandThumbDownIcon} from '@heroicons/vue/24/outline';
import { VProgressLinear,VProgressCircular  } from 'vuetify/lib/components/index.mjs';
import {ref} from 'vue'
const props = defineProps({
  package:Object,
  rider:Object  
})
const emits  = defineEmits(['confirm','decline','close'])
const Package = ref(props.package)
const rider = ref(props.rider)
</script> 

<style>

</style>