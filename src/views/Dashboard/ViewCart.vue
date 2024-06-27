<template>
  <div class="bg-black inset-0 fixed  w-screen opacity-95 h-screen flex justify-center place-items-center">
    <div class="bg-red-500 opacity-1  sm:w-1/2 h-fit py-3 rounded-md " >
        <div class="flex justify-end px-4 place-items-end">
              <XMarkIcon class="w-5 bg-slate-800 hover:bg-black rounded-full" @click.prevent="emit('closeCartList')"></XMarkIcon>
        </div>
        <div class="text-center py-2">
            Items that are  in the cart:
        </div>
        <table class="mx-auto w-3/4 text-center border">
          <thead>
            <tr>
              <th class="px-1">Product</th>
              <th class="px-1">Price</th>
              <th class="px-1">Qunatity</th>
              <th class="px-1">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in Products" >
              <td>{{product.product}}</td>
              <td>{{product.price}}</td>
              <td>{{product.quantity}}</td>
              <td>{{product.total}}</td>

            </tr>
          </tbody>
        </table>
        <!-- <div class="text-center my-10 font-bold">
            Total amount to pay is : Ksh <span class="text-green-500 hover:underline">  {{ total }}</span> only
        </div> -->
        <div class="flex  w-full justify-around place-items-end pt-3">
          <button  @click.prevent="addItems" class="bg-blue-500 hover:bg-blue-700 py-1 px-2 rounded-md"> Add Items</button>
          <button  @click.prevent="emit('closeCartList')" class="bg-green-500 hover:bg-green-700 py-1 px-2 rounded-md">Continue</button>
        </div>
    </div>
  </div>
  
</template>

<script setup>
import store from '../../store'
import router  from '../../router'
import {ref} from  'vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
const Products = ref(store.state.products.products)
// const total = ref(store.state.products.total)

const emit = defineEmits(['closeCartList'])

function addItems(){
  router.push({name:"Shopping"})
}


</script>

<style>

</style>