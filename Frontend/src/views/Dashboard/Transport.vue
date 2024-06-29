<template>
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2
      class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
    >Transport</h2>
    <p class="text-center text-sm">..lets get you there</p>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm sm:px-0 px-5">
    <form class="space-y-6" @submit.prevent="rideRequest">
      <div>
        <label
          for="currentLocation"
          class="block text-sm font-medium leading-6 text-gray-900"
        >Current Location</label>
        <div class="mt-2">
          <input
            id="currentLocation"
            name="currentLocation"
            type="text"
            required
            v-model="ride.currentLocation"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
          />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label
            for="destination"
            class="block text-sm font-medium leading-6 text-gray-900"
          >Destination</label>
        </div>
        <div class="mt-2">
          <input
            id="destination"
            name="destination"
            type="text"
            autocomplete
            required
            v-model="ride.destination"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
          />
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label
            for="pickUpTime"
            class="block text-sm font-medium leading-6 text-gray-900"
          >Pick-up time</label>
        </div>
        <div class="mt-2">
          <input
            id="pickUpTime"
            name="pickUpTime"
            type="time"
            autocomplete
            required
            v-model="ride.pickupTime"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
          />
        </div>
      </div>

      <!-- <div>
            <div class="flex justify-around">
                <button class="px-3 py-2 rounded-lg bg-green-500 hover:bg-lime-700">Pick a rider</button>
                <button class="px-3 py-2 rounded-lg bg-green-800 hover:bg-lime-700">Random rider</button>
            </div>
            <select name="rider" id="rider"  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="martin">Martin</option>
                    <option value="Juma">Juma</option>
                    <option value="Ali">Ali</option>
            </select>
      </div>-->

      <div>
        <button
          type="submit"
          class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          <span v-if="!submitted">Request Rider</span>
          <VProgressCircular v-else bg-color="white" size="25" color="blue" indeterminate="10"></VProgressCircular>
        </button>
      </div>
    </form>
    <div></div>
    <RideConfirmation
      v-if="submitted"
      @confirm="confirm"
      @decline="decline"
      @close="close"
      :transport="transportData"
      :rider="ridersData"
    ></RideConfirmation>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import store from '../../store'
import RideConfirmation from '../../components/RideConfirmation.vue'
import {
  VSkeletonLoader,
  VProgressCircular,
} from 'vuetify/lib/components/index.mjs'
import { useRouter } from 'vue-router'
const ride = ref({
  currentLocation: '',
  destination: '',
  pickupTime: '',
})
const router = useRouter()
const transportData = ref(store.state.transport)
const ridersData = ref(store.state.rider)
const submitted = ref(false)
function rideRequest() {
  store.dispatch('rideRequest', ride.value)
  submitted.value = true
}
function confirm() {
  store.dispatch('rideConfirmation', true)
}
function decline() {
  store.dispatch('rideConfirmation', false)
}
function close(data) {
  if (data == 1) {
    router.push({
      name: 'Home',
    })
    store.dispatch('ride', 1)
  } else if (data == 0) {
    store.dispatch('ride', 0)
    submitted.value = false
    ride.value.currentLocation = ''
    ride.value.destination = ''
    ride.value.pickupTime = ''
    router.push({
      name: 'Transport'.value,
    })
  }
}
</script>

<style>
</style>