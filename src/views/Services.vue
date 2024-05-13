<template>
  <div class="flex justify-around py-10 gap-2">
    <v-card class="mx-auto" max-width="400" v-for="(srv, index) in service" :key="index">
      <v-img class="align-end text-green" height="200" :src="srv.image" cover>
        <!-- <v-card-title class="text-black text-3xl">{{srv.name}}</v-card-title> -->
      </v-img>

      <!-- <v-card-subtitle class="pt-4">
        Number 10
      </v-card-subtitle>-->
      <v-card-title class="text-blue-500 text-3xl">{{srv.name}}</v-card-title>

      <v-card-text>
        <div>{{srv.short_desc}}</div>

        <div>{{srv.desc}}</div>
      </v-card-text>

      <v-card-actions>
        <!-- <v-btn color="orange" text="Share"></v-btn> -->
        <!-- <rounter-link :to="{name:'Home'}">one</rounter-link> -->
        <router-link :to="{name:srv.linkName}">
          <v-btn color="blue" text="Explore"></v-btn>
        </router-link>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const services = [
  {
    name: 'Shopping',
    short_desc: 'Easy way to get shopping done',
    desc: 'Products depends on where you want to get them from Supermarket(magunus), Retails(Sifa) or fresh groceries we got you covered',
    image: '../../public/images/groceries.jpg',
    link: '/shopping',
    linkName: 'Shopping',
  },
  {
    name: 'Transport',
    short_desc: 'Just a  press we get at your doorstep',
    desc: 'Tired  of different Moto-Riders?? lets sum it up for you just right at your doorstep with no stress.we got you on this',
    image: '../../public/images/customer.jpg',
    link: '/transport',
    linkName: 'Transport',
  },
  {
    name: 'Package Delivery',
    short_desc: 'Want to send a package real quick??',
    desc: 'Let trust be on us.  The team is ready to save  your time at a cheap fee and geuss what you get to pick your delivery guy',
    image: '../../public/images/red.jpg',
    link: '/pacakgeDelivery',
    linkName: 'PackageDelivery',
  },
]
const service = ref(services)
</script>