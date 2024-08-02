<template>
    <!-- USERS  DATA -->
    <div class="w-screen flex justify-evenly py-2 my-5">
        <Card class="w-1/4" v-for="(value,i) in users" :key="i">
            <template #title>
                <div class="flex justify-around align-middle ">
                    <div  class="text-3xl font-bold text-green-400">
                       No. {{ value.name }}
                    </div>   
                    <div class="text-4xl font-bold">
                        {{ value.value }}
                    </div>                 
                </div>

            </template>
        </Card>
    </div>
    
    <!-- ACTIVITY STATICTICS -->
    <div class="screen flex justify-around py-2">
        <!-- <div style="background-repeat: no-repeat; background-size: cover;" class="bg-[url('/images/beach.jpeg')] h-[100px] w-1/4 mx-3 rounded-md " v-for="(value,i) in service" :key="i">
            <div class="flex w-3/4  text-center">
                <div class="w-[30%] ">
                    <v-icon size="80" :icon=value.icon></v-icon>
                </div>
                <div class="w-full">
                    <div class="font-semibold">{{value.name}}</div>
                    <div class="text-4xl font-extrabold">{{value.value}}</div>
                </div>
            </div>
        </div> -->
        <Card class="w-1/4" v-for="(value,i) in service" :key="i">
            <template #title>
                <div class="flex justify-around align-middle ">
                    <div  class="text-3xl font-bold">
                        {{ value.name }}
                    </div>   
                    <div class="text-2xl">
                        <Knob v-model="tally"></Knob>
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
import {ref} from 'vue'
import PackageDeliveryIconVue from "../../components/Icons/PackageDeliveryIcon.vue"
import RideIconVue from "../../components/Icons/RideIcon.vue"
import ShoppingIconVue from "../../components/Icons/ShoppingIcon.vue"
import RecentActivities from "./RecentActivities_Admin.vue"
import DataActivities from "./DataActivities_Admin.vue"
import RideData from "./Rides_Delivery/RideData_Delivery.vue"
import DeliveryData from "./Delivery_Delivery/DeliveryData_Delivery.vue"
import ShoppingData from "./Shopping_Delivery/ShoppingData_Delivery.vue"
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';
import Card from 'primevue/card';
import Knob from 'primevue/knob';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
const tally = ref(300)
const service = [
    {
        name:'Ride',
        value:2,
        icon:RideIconVue
    },
    {
        name:'Shopping',
        value:30,
        icon:ShoppingIconVue
    },
    {
        name:'Delivery',
        value:24,
        icon:PackageDeliveryIconVue
    },

]
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