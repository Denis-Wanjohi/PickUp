<template>
<!-- ADMIN -->
    <Admin></Admin>
<!-- RIDER -->
    <!-- <Rider></Rider> -->
<!-- CLIENT -->
    <!-- <Client></Client> -->

</template>

<script setup>
import {onMounted, ref} from 'vue'
import store from '../store'
import Admin from './Dashboard/AdminDashboard.vue'
import Rider from './Dashboard/RiderDashboard.vue'
import Client from './Dashboard/ClientDashboard.vue'
store.dispatch('data')
const user = ref(store.state.user )
let str = ref(store.state.user)
let display =  ref()
let x = 0;
setInterval(() => {
    display.value = data[x]
    // console.log(display.value)
    x++
    if(x>=3){
        x = 0;
    }
}, 5000);

const data = [
{
        title:'SHOPPING',
        note:'Quick and Easy',
        description:'Make the list with clear specification, we will get it at your doorstep',
        link:'Shopping',
        image:'/images/download.jpg',
        color:'blue'
    },
    {
        title:'TRANSPORT',
        note:'Fast and Convinient',
        description:'Request for transport services at the comfort of your house',
        link:'Transport',
        image:'/images/customer.jpg',
        color:'green'

    },
    {
        title:'PACKAGE DELIVERY',
        note:'Safe and OnTime',
        description:'Specify  the destination and the time, we delivery it quick',
        link:'PackageDelivery',
        image:'/images/red.jpg',
        color:'purple'

    }
]

</script>

<style>

</style>