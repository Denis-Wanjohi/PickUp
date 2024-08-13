<template>
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight ">Package Delivery</h2>
    <p  class="text-center text-sm">...where should i place it?</p>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm sm:px-0 px-5">
    <form class="space-y-6" @submit.prevent="delivery">
      <div class="my-10 mx-auto">
        <FloatLabel>
            <InputText  id="currentLocation" class="w-full" v-model="Package.location" required />
            <label for="currentLocation">Current Location</label>
        </FloatLabel>
      </div>

      <div class="my-10 mx-auto">
        <FloatLabel>
            <InputText  id="destination" class="w-full" v-model="Package.destination" required />
            <label for="destination">Destination</label>
        </FloatLabel>
      </div>

      <div>
        <FloatLabel>
            <Select v-model="Package.rider" :options="riders" optionLabel="name" placeholder="type" 
               class="block w-full rounded-md border-1 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
            <label for="rider">Rider :</label>
        </FloatLabel>
      </div>

      <div class="my-10 mx-auto">
        <FloatLabel>
            <DatePicker id="time" hourFormat="12" v-model="Package.time" timeOnly fluid required/>
            <label for="time">PickUp Time</label>
        </FloatLabel>
      </div>

      <div>
        <FloatLabel>
            <Select v-model="Package.weight" :options="weight" optionLabel="name" placeholder="type" 
               class="block w-full rounded-md border-1 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
            />
            <label for="rider">Weight :</label>
        </FloatLabel>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <span>Request Rider</span>
            <!-- <VProgressCircular v-else bg-color="white" size="25"color="blue" indeterminate="10"></VProgressCircular> -->
        </button>
      </div>
    </form>
  </div>
  <Dialog v-model:visible="submitted" modal header="Delivery details" :style="{ width: '50vw' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
      <div class="border w-full">
        <div class="text-center  w-fit   mx-auto">
          <div>Hello</div>
          <div class="my-3"><span class="font-bold ">Location: </span>{{ Package.location }}</div>
          <div class="my-3"><span class="font-bold ">Destination: </span>{{Package.destination}}</div>
          <div class="my-3"><span class="font-bold ">Pick Up time: </span>{{ timeFormatter(Package.time) }}</div>
          <div class="my-3"><span class="font-bold ">Rider: </span>{{ Package.rider['name'] }}</div>
          <div class="my-3"><span class="font-bold ">Weight: </span>{{ Package.weight['name'] }}</div>
        </div>
        <div class="w-3/4 flex justify-around py-5 mx-auto">
          <Button label="Cancel"severity="danger" @click.prevent="response('cancel')"></Button>
          <Button label="Request" severity="success" @click.prevent="response('agree')"></Button>
        </div>
      </div>
    </Dialog>
</template>

<script setup>
import {ref} from 'vue'
import store from '../../store';
import FloatLabel from 'primevue/floatlabel'
import InputText from 'primevue/inputtext'
import DatePicker from 'primevue/datepicker'
import Select from 'primevue/select'
import Dialog from 'primevue/dialog'
import Button from 'primevue/button'
import Payments from './DeliveryCheckout.vue'
import DeliveryConfirmation from '../../components/DeliveryConfirmation.vue'
const rider = store.state.rider
const pack = store.state.package
const submitted = ref(false)

const Package = ref({
    location:'',
    destination:'',
    weight:'',
    time:'',    
    rider:'',    
})
const riders = ref([
    { name: 'Kimi', code: 'NY' },
    { name: 'Tommy', code: 'RM' },
    { name: 'Johny', code: 'LDN' },
    { name: 'Denny', code: 'IST' },
    { name: 'Jowie', code: 'PRS' }
]);
const weight = ref([
    { name: 'More than 50  kg', code: '>50' },
    { name: 'Less than 50 kg', code: '<50' },
]);
const requestRider = ref(false)
function delivery(){
  submitted.value = true
}
function response(data){
  if(data == 'agree'){
    Package.value.pickupTime = timeFormatter(Package.value.time)
    Package.value.rider = Package.value.rider['name']
    Package.value.weight = Package.value.weight['code']
    store.dispatch('delivery',Package.value)
    .then(()=>{
      submitted.value = false
      Package.value.location = '',
      Package.value.destination = '',
      Package.value.weight = '',
      Package.value.time = '',
      Package.value.rider = ''
    })
    .catch((err)=>{
      console.log(err)
      alert('error seen at delivery request')
    })
  }else if(data == 'camcel'){
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