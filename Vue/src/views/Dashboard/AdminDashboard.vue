<template>
    <div class="screen flex py-2">
        <div class="bg-blue-400 h-[100px] w-1/2 mx-3 rounded-md text-white" v-for="(value,i) in users" :key="i">
            <div class="flex w-3/4  text-center">
                <div class="w-1/4"></div>
                <div class="w-full">
                    <div>{{value.name}}</div>
                    <div class="text-4xl">{{value.value}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="screen flex justify-around py-2">
        <div style="background-repeat: no-repeat; background-size: cover;" class="bg-[url('/images/beach.jpeg')] h-[100px] w-1/4 mx-3 rounded-md " v-for="(value,i) in service" :key="i">
            <div class="flex w-3/4  text-center">
                <div class="w-[30%] ">
                    <v-icon size="80" :icon=value.icon></v-icon>
                </div>
                <div class="w-full">
                    <div class="font-semibold">{{value.name}}</div>
                    <div class="text-4xl font-extrabold">{{value.value}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <Splitter  class="max-h-[400px] mb-8 mx-5">
            <SplitterPanel class="flex items-center justify-center" size="75"> 
                <RecentActivities></RecentActivities>
            </SplitterPanel>
            <SplitterPanel class="flex items-center justify-center" size="25">
                <DataActivities></DataActivities>
            </SplitterPanel>
        </Splitter>
    </div>

    <RideActivities></RideActivities>
    
    
</template>

<script setup>
import PackageDeliveryIconVue from "../../components/Icons/PackageDeliveryIcon.vue"
import RideIconVue from "../../components/Icons/RideIcon.vue"
import ShoppingIconVue from "../../components/Icons/ShoppingIcon.vue"
import RecentActivities from "./RecentActivities_Admin.vue"
import DataActivities from "./DataActivities_Admin.vue"
import RideActivities from "./RideActivities_Admin.vue"
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';

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
        name:'Package Delivered',
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