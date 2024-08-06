<template>
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight ">Package Delivery</h2>
    <p  class="text-center text-sm">...where should i place it?</p>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm sm:px-0 px-5">
    <form class="space-y-6" @submit.prevent="packageRider">
      <div>
        <label for="loaction" class="block text-sm font-medium leading-6 text-gray-900">Current Location</label>
        <div class="mt-2">
          <input id="location" name="location" type="text" required="" v-model="Package.location" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="destination" class="block text-sm font-medium leading-6 text-gray-900">Destination</label>
        </div>
        <div class="mt-2">
          <input id="destination" name="destination" type="text" autocomplete=""  required="" v-model="Package.destination" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">Weight</label>
        </div>
        <div class="mt-2">
          <!-- <input id="pickUpTime" name="pickUpTime" type="time" autocomplete=""  required="" v-model="ride.time" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" /> -->
            <select name="weight" id="weight" v-model="Package.weight" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="50>">less or equal to 50kg</option>
                <option value="50<">more than 50kg</option>
            </select>
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="pickUpTime" class="block text-sm font-medium leading-6 text-gray-900">Pick-up time</label>
        </div>
        <div class="mt-2">
          <input id="pickUpTime" name="pickUpTime" type="time" autocomplete=""  required="" v-model="Package.time" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
      </div>



      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <span>Request Rider</span>
            <!-- <VProgressCircular v-else bg-color="white" size="25"color="blue" indeterminate="10"></VProgressCircular> -->
        </button>
      </div>
    </form>
 
    <!-- <RideConfirmation v-if="submitted" @confirm="confirm" @decline="decline" @close="close" :transport="transportData" :rider="ridersData"></RideConfirmation> -->
  </div>
</template>

<script setup>
import {ref} from 'vue'
import store from '../../store';
import Payments from './DeliveryCheckout.vue'
import DeliveryConfirmation from '../../components/DeliveryConfirmation.vue'
const rider = store.state.rider
const pack = store.state.package
const Package = ref({
    location:'',
    destination:'',
    weight:'',
    time:'',    
})
const requestRider = ref(false)
function packageRider(){
    store.dispatch('packageRider',Package.value)
    .then(()=>{
      requestRider.value = true
    })
    .catch((er)=>{
      alert(er)
    })
}
function confirm(){
  store.dispatch('packageConfirmation',1)
  .then(()=>{
    requestRider.value = false
  })
  .catch((err)=>{
    alert(err)
  })
}
function decline(){
  store.dispatch('packageConfirmation',0)
  .then(()=>{
    requestRider.value = false
  })
  .catch((err)=>{
    alert(err)
  })
}
</script>

<style>

</style>