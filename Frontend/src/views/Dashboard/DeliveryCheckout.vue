<template>
  <div class="inset-0 fixed h-screen flex  place-items-center justify-center bg-slate-100 opacity-95">
    <div  class="bg-slate-300 flex justify-center place-items-center h-fit py-10 opacity-100">
        <div class="w-3/4 shadow shadow-black pb-10">
            <div class="text-center border-b-2">
                <p>Hello <span>Kim,</span></p>
                <p>Amount to pay: <span class="font-bold">Ksh {{Package.price}} only </span></p>
                <p>Package information <button class="bg-green-400 px-2 border rounded-md text-sm hover:font-bold" @click.prevent="showCartList = true">Package</button> </p>
            </div>
            <div class="text-center">
                <p class="font-bold">Please follow the steps as they follow:</p>
                <!-- <p class="font-mono">1. Request for a Rider to take care of your shopping</p> -->
            </div>


            <!-- <div  v-if="riderResponse.data.response !== 'available'">
            <div class="flex justify-around place-items-center">
                <button type="submit" @click.prevent="makeRequest" class="bg-blue-500 hover:bg-blue-600  px-1 py-1 rounded-md font-bold">Make a request</button>
            </div>
            <p class="text-xs text-center">This will take a while to get a confirmation from available person</p>
            </div>

            <div v-else>
                    <p class="flex gap-3 font-bold  mx-auto justify-center text-sm">Request already made <CheckIcon class="w-5 bg-green-500 rounded-full border-2 border-black"></CheckIcon> </p>
                    <p  class="text-center text-sm">{{ riderResponse.data.username }} will take care of your request</p>
                    <p  class="text-center text-sm">Transport =  Ksh <span class="font-bold">{{ riderResponse.data.price }} </span> </p>
                    <p  class="text-center text-sm">Your cart =  Ksh <span class="font-bold">{{ cart.total}}</span>   </p>
                    <p  class="text-center text-sm">Total =  Ksh <span class="font-bold">{{ Number(cart.total) + Number(riderResponse.data.price) }} </span> </p>
                    <div class="flex justify-around place-items-center">
                        <button @click.prevent="continueProcess('confirmed')" v-if="!cart.confirmed" class="bg-green-500 hover:bg-green-600  px-1 py-1 rounded-md font-bold">All Good 👍</button>
                        <button  v-if="cart.confirmed" class="bg-green-500 hover:bg-green-600  px-1 py-1 rounded-md font-bold">All Good 👍</button>
                        <button @click.prevent="continueProcess('canceled')"  v-if="!cart.confirmed" class="bg-red-500 hover:bg-red-600  px-1 py-1 rounded-md font-bold">Cancel Request</button>
                    </div>
            </div> -->
            <div>
                <div class="text-center mt-10">
                    <p class="font-mono">1. Enter the MPESA number that will make the payment</p>
                </div>
                <form v-if="Payments.number == ''" @submit.prevent="setNumber" class="flex justify-evenly place-items-center">
                    <label for="phoneNumber" class="block text-sm font-medium leading-6 text-gray-900">Phone Number:</label>
                    <input id="phoneNumber" placeholder="+2547XXXXXX"  type="text" v-model="user.number"  required class="block w-wrap rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    <button type="submit" class="bg-green-500 hover:bg-green-600  px-1 py-1 rounded-md font-bold">submit</button>
                </form> 
                
                <p v-else class="flex gap-3  py-5 font-bold  mx-auto justify-center text-sm"><span class="text-md font-thin">MPESA number:</span> {{ Payments.number }} <CheckIcon class="w-5 bg-green-500 rounded-full border-2 border-black"></CheckIcon> </p>

            </div>
            
            <div v-if="Payments.number != ''">
                <div class="text-center mt-10">
                    <p class="font-mono">3. Enter the MPESA confirmation code</p>
                </div>
                <form v-if="Payments.mpesaCode == ''"  @submit.prevent="confirmationCode" class="flex justify-evenly place-items-center">
                    <label for="confirmationCode" class="block text-sm font-medium leading-6 text-gray-900">Confirmation Code:</label>
                    <input id="confirmationCode" name="confirmationCode" type="text" placeholder="QWERZ4567" v-model=" user.confirmationCode"  required="" class="block w-wrap rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    <button type="submit" class="bg-green-500 hover:bg-green-600  px-1 py-1 rounded-md font-bold">submit</button>
                </form>
                <p v-else class="flex gap-3  py-5 font-bold  mx-auto justify-center text-sm"><span class="text-md font-thin">MPESA confirmation code:</span> {{ Payments.mpesaCode }} <CheckIcon class="w-5 bg-green-500 rounded-full border-2 border-black"></CheckIcon> </p>

            </div>
        </div>
    </div>
    <div>
        <Cart @closeCartList="closeOvelay" v-if="showCartList"></Cart>
        <!-- <Alert @closeCartList="closeOvelay" v-if="showCartList"></Cart> -->
        <Alert v-if="complete"></Alert>
    </div>
   
    
  </div>
</template>

<script setup>
import { ref} from 'vue'
import Cart from './ViewCart.vue'
import store from '../../store';
import { CheckIcon } from '@heroicons/vue/24/outline';
import { useRouter } from 'vue-router';
import Alert from '../../components/Alert.vue'
store.dispatch('cartItems')
const Package = store.state.package
const Payments = store.state.payments
const showCartList = ref(false)
const requestMade = ref(false)
const riderResponse = ref(store.state.rider) 
const cart = ref(store.state.products)
const confirmation = ref()
const confirmedTotal = ref(store.state.products.confirmed)
const router = useRouter()
const complete = ref(false)

const user = ref({
    number:'',
    confirmationCode:''
})
const closeOvelay = ()=>{
    showCartList.value = false
}

function makeRequest(){
    store.dispatch("riderRequest")
}
function continueProcess(data){
   store.dispatch('continueProcess',data)
   .then((data)=>{
        if(data == 'canceled'){
            router.push('/shopping')
        }
   })
}
function setNumber(){
    store.dispatch('setPackageNumber',user.value)
}
function confirmationCode(){
    console.log("one");
    alert();
    store.dispatch('confirmationPackageCode',user.value)
          .then((data)=>{
                   console.log(data)
                 router.push({name:"Home"})
          })

}

</script>
<style>

</style>