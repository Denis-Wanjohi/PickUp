<template>
  <div class="bg-black inset-0 fixed  w-screen opacity-95 h-screen flex justify-center place-items-center">
    <div class="bg-red-500 opacity-1  w-1/2 h-fit py-3 rounded-md " >
        <div class="flex justify-end px-4 place-items-end">
              <XMarkIcon class="w-5 bg-slate-800 hover:bg-black rounded-full" @click.prevent="emit('closeCartList')"></XMarkIcon>
        </div>
        <div class="text-center py-2">
            Items that are  in the cart:
        </div>
        <table class="mx-auto w-3/4 text-center border">
          <thead>
            <tr>
              <th>Location</th>
              <th>Destination</th>
              <th>Time</th>
              <th>Weight</th>
            </tr>
          </thead>
          <tbody>
            <tr >
              <td>{{ Package.location}}</td>
              <td>{{ Package.destination}}</td>
              <td>{{ Package.time}}</td>
              <td>{{ Package.weight}}</td>
            
            </tr>
          </tbody>
        </table>
        <!-- <div class="text-center my-10 font-bold">
            Total amount to pay is : Ksh <span class="text-green-500 hover:underline">  {{ total }}</span> only
        </div> -->
        <div class="flex  w-3/4 justify-end place-items-end">
          <button  @click.prevent="emit('closeCartList')" class="bg-green-500 hover:bg-green-700 py-1 px-2 rounded-md">Continue</button>
        </div>
    </div>
  </div>
  
</template>

<script setup>
import store from '../../store'
import {ref} from  'vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
const Package = ref(store.state.package)
// const total = ref(store.state.products.total)

const emit = defineEmits(['closeCartList'])


</script>

<style>

</style>