<template>
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2
      class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight "
    >Transport</h2>
    <p class="text-center text-sm">..lets get you there</p>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm sm:px-0 px-5">
    <form class="space-y-6" @submit.prevent="rideRequest">
      <div class="my-10 mx-auto">
        <FloatLabel>
            <InputText  class="w-full" id="location" v-model="ride.currentLocation" required />
            <label for="location">Location</label>
        </FloatLabel>
      </div>


      <div class="my-10 mx-auto">
        <FloatLabel>
            <InputText  id="destination" class="w-full" v-model="ride.destination" required />
            <label for="destination">Destination</label>
        </FloatLabel>
      </div>

      <div class="my-10 mx-auto">
        <FloatLabel>
            <DatePicker id="time" hourFormat="12" v-model="ride.pickupTime" timeOnly fluid required/>
            <label for="time">PickUp Time</label>
        </FloatLabel>
      </div>

      <div>
        <FloatLabel>
            <Select v-model="ride.rider" :options="riders" optionLabel="name" placeholder="type" 
               class="block w-full rounded-md border-1 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
            <label for="rider">Rider :</label>
        </FloatLabel>
      </div>


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
    <Dialog v-model:visible="submitted" modal header="Ride Confirmation" :style="{ width: '50vw' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
      <div class="border w-full">
        <div class="text-center  w-fit   mx-auto">
          <div>Hello</div>
          <div class="my-3"><span class="font-bold ">Location:</span>{{ ride.currentLocation }}</div>
          <div class="my-3"><span class="font-bold ">Destination:</span>{{ride.destination}}</div>
          <div class="my-3"><span class="font-bold ">Pick Up time:</span>{{ timeFormatter(ride.pickupTime) }}</div>
          <div class="my-3"><span class="font-bold ">Rider:</span>{{ ride.rider['name'] }}</div>
        </div>
        <div class="w-3/4 flex justify-around py-5 mx-auto">
          <Button label="Cancel"severity="danger" @click.prevent="response('cancel')"></Button>
          <Button label="Request" severity="success" @click.prevent="response('agree')"></Button>
        </div>
      </div>
    </Dialog>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import store from '../../store'
import FloatLabel from 'primevue/floatlabel'
import InputText from 'primevue/inputtext'
import DatePicker from 'primevue/datepicker'
import Select from 'primevue/select'
import Dialog from 'primevue/dialog'
import Button from 'primevue/button'
import { useRouter } from 'vue-router'
const ride = ref({
  currentLocation: '',
  destination: '',
  pickupTime: '',
  rider:'',
})
const riders = ref([
    { name: 'Kimi', code: 'NY' },
    { name: 'Tommy', code: 'RM' },
    { name: 'Johny', code: 'LDN' },
    { name: 'Denny', code: 'IST' },
    { name: 'Jowie', code: 'PRS' }
]);
const router = useRouter()
const transportData = ref(store.state.transport)
const ridersData = ref(store.state.rider)
const submitted = ref(false)
function rideRequest() {
  // store.dispatch('rideRequest', ride.value)
  submitted.value = true
}
function response(data){
  if(data == 'agree'){
    ride.value.pickupTime = timeFormatter(ride.value.pickupTime)
    ride.value.rider = ride.value.rider['name'] 
    store.dispatch('rideRequest', ride.value)
    .then(()=>{
      submitted.value = false
      ride.value.currentLocation = '',
      ride.value.destination = '',
      ride.value.pickupTime = '',
      ride.value.rider = ''
     
    })
  }else if(data == 'cancel'){
    submitted.value = false
  }
}
function timeFormatter(date){
    let  pass_time =  new Date(date)
    const hours = pass_time.getHours().toString().padStart(2, '0');
    const minutes = pass_time.getMinutes().toString().padStart(2, '0');
    const seconds = pass_time.getSeconds().toString().padStart(2, '0');
    return `${hours}:${minutes}:${seconds}`;
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