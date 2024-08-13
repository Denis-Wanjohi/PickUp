<template>
    
    <!-- ACTIVITY STATICTICS -->
    <div class="screen flex justify-around py-2">
        <Card class="w-1/4" v-for="(value,i) in service" :key="i">
            <template #title>
                <div class="flex justify-around align-middle ">
                    <div  class="text-3xl font-bold">
                        {{ value.name }}
                    </div>   
                    <div class="text-2xl">
                        <Knob v-model=value.value readonly></Knob>
                    </div>                 
                </div>
            </template>
        </Card>
    </div>

    <!-- DETAILED STATISCTICS -->
    <div class=" border my-5 p-0">
        <div class="py-5">
            <RideData></RideData>
        </div>
        <div class="py-5">
            <DeliveryData></DeliveryData>
        </div>
        <div class="py-5">
            <ShoppingData></ShoppingData>
        </div>
    </div>
 

  

 
    
</template>

<script setup>
import {onMounted, ref,watch} from 'vue'
import PackageDeliveryIconVue from "../../components/Icons/PackageDeliveryIcon.vue"
import RideIconVue from "../../components/Icons/RideIcon.vue"
import ShoppingIconVue from "../../components/Icons/ShoppingIcon.vue"
import RideData from "./Rides_Client/RideData_Client.vue"
import DeliveryData from "./Delivery_Client/DeliveryData_Client.vue"
import ShoppingData from "./Shopping_Client/ShoppingData_Client.vue"
import Card from 'primevue/card';
import Knob from 'primevue/knob';
import store from '../../store/index'
const user = ref(store.state.user)
const service = ref()
watch(store=>{
    service.value = [
    {
        name:'Ride',
        value:user.value.rides.length,
        icon:RideIconVue
    },
    {
        name:'Shopping',
        value:user.value.shopping.length,
        icon:ShoppingIconVue
    },
    {
        name:'Delivery',
        value:user.value.packages.length,
        icon:PackageDeliveryIconVue
    },
]
})
const tally = ref(0)
let x = 20
setTimeout(()=>{
    while(tally.value < x){
        tally.value++
    }
},2000)

const users = [
    {
        name:'Clients',
        value:24
    },
    {
        name:'Riders',
        value:24
    },
]
</script>