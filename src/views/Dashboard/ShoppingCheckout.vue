<template>
  <div class="overflow-scroll">
    <div  class="bg-slate-300 flex justify-center place-items-center h-screen">
        <div class="w-3/4 shadow shadow-black pb-10" v-if="cart !== undefined">
            <div class="text-center border-b-2">
                <p>Hello <span   v-if="userData !=null">{{ userData.name }}</span></p>
                <p>Your shopping cart amounts to <span class="font-bold" >Ksh {{cart.total}} only </span></p>
                <p>Your shopping cart items are <button class="bg-green-400 px-2 border rounded-md text-sm hover:font-bold" @click.prevent="showCartList = true">Cart</button> </p>
            </div>
            <div class="text-center">
                <p class="font-bold">Please follow the steps as they follow:</p>
                <p class="font-mono">1. Request for a Rider to take care of your shopping</p>
            </div>


            <div  v-if="riderResponse.response !== 'available'">
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
            </div>
          
            <div v-if="cart.confirmed">
                <div class="text-center mt-10" v-if="cart.destination != ''">
                    <p class="font-mono">2. What will be the destination of your shopping?</p>
                </div>
                <form v-if="cart.destination == ''" @submit.prevent="setDestination" class="flex flex-wrap justify-evenly place-items-center px-1">
                    <label for="destination" class="sm:block hidden text-sm font-medium leading-6 text-gray-900 ">Destination:</label>
                    <input id="destination" placeholder="kaithe apartments"  type="text" v-model="user.destination"  required class="block w-wrap rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    <button type="submit" class="bg-green-500 hover:bg-green-600  px-1 py-1 my-2 sm:my-0 rounded-md font-bold">submit</button>
                </form>

                <p v-else class="flex gap-3  py-5 font-bold  mx-auto justify-center text-sm"><span class="text-md font-thin">Destination:</span> {{ cart.destination }} <CheckIcon class="w-5 bg-green-500 rounded-full border-2 border-black"></CheckIcon> </p>
            </div>
           
            
            
            <div v-if="cart.destination != ''">
                <div class="text-center mt-10">
                    <p class="font-mono">3. Enter the phone number to call incase of anything</p>
                </div>
                <form v-if="cart.numberToCall == ''" @submit.prevent="setNumber" class="flex flex-wrap justify-evenly place-items-center px-1">
                    <label for="numberToCall" class="sm:block hidden text-sm font-medium leading-6 text-gray-900 ">Phone Number:</label>
                    <input id="numberToCall" placeholder="+2547XXXXXX"  type="text" v-model="user.numberToCall"  required class="block w-wrap rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    <button type="submit" class="bg-green-500 hover:bg-green-600  px-1 py-1 my-2 sm:my-0 rounded-md font-bold">submit</button>
                </form>
                <p v-else class="flex gap-3  py-5 font-bold  mx-auto justify-center text-sm"><span class="text-md font-thin">Phone Number :</span> {{ cart.numberToCall }} <CheckIcon class="w-5 bg-green-500 rounded-full border-2 border-black"></CheckIcon> </p>
            </div>

            <div v-if="cart.numberToCall != ''">
                <div class="bg-blue px-2 py-1 rounded-md text-center font-semibold w-3/4 mx-auto">ALL GOOD</div>
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
const cart = ref()
console.log(cart.value)
// store.dispatch('cartItems').then(()=>{
//     cart.value  = store.state.products
// })
// store.dispatch('userData')
if(cart.total == ''){
    console.log(cart.total)
}

const showCartList = ref(false)
const requestMade = ref(false)
const riderResponse = ref(store.state.rider) 
// const cart = ref(store.state.products)
const confirmation = ref()
const confirmedTotal = ref(store.state.products.confirmed)
const router = useRouter()
const complete = ref(false)
const userData = store.state.user.data[0]

const user = ref({
    number:'',
    confirmationCode:'',
    destination:''
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
    store.dispatch('setNumber',user.value)
}
function confirmationCode(){
    store.dispatch('confirmationCode',user.value)
}
function setDestination(){
    store.dispatch('setDestination',user.value)
}

</script>
<style>

</style>