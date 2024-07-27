<template>
  <div class="mx-3 flex justify-center align-middle h-[30vh] border rounded-xl my-2 bg-gradient-to-r from-slate-700 to-yellow-800">
    <div class="w-1/2 flex align-center justify-center">
      <div>
        <div  class="text-4xl font-bold">Step up your game,get your shopping and package delivered in an easy way</div>
        <div>Beside offering ride services, we let you focus on your work as we get you going on other services</div>
      </div>
    </div>
    <div class="w-1/4 flex align-center justify-center">
      <div class="px-5 py-2 w-fit h-fit rounded hover:bg-white bg-amber-700 border ">Get started</div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const services = [
  {
    name: 'Shopping',
    short_desc: 'Easy way to get shopping done',
    desc: 'Products depends on where you want to get them from Supermarket(magunus), Retails(Sifa) or fresh groceries we got you covered',
    image: '/images/groceries.jpg',
    link: '/shopping',
    linkName: 'Shopping',
  },
  {
    name: 'Transport',
    short_desc: 'Just a  press we get at your doorstep',
    desc: 'Tired  of different Moto-Riders?? lets sum it up for you just right at your doorstep with no stress.we got you on this',
    image: '/images/customer.jpg',
    link: '/transport',
    linkName: 'Transport',
  },
  {
    name: 'Package Delivery',
    short_desc: 'Want to send a package real quick??',
    desc: 'Let trust be on us.  The team is ready to save  your time at a cheap fee and geuss what you get to pick your delivery guy',
    image: '/images/red.jpg',
    link: '/pacakgeDelivery',
    linkName: 'PackageDelivery',
  },
]
const service = ref(services)
</script>