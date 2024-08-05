<template>
    
    <div class="card flex justify-center">
        <Drawer v-model:visible="visible" header="Menu" position="right">
            <div class="flex-row justify-between h-[40vh] ">
                <div class="">
                    <div class="flex justify-evenly align-middle text-start border mx-auto cursor-pointer my-2" @click.prevent="nextPage(item)" v-for="(item,i) in items">
                        <div class="h-full w-1/4 flex justify-center align-middle my-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[40px]" viewBox="0 0 17 24">
                                <rect width="17" height="24" fill="none" />
                                <path fill="currentColor" d="M8.632 15.526a2.112 2.112 0 0 0-2.106 2.105v4.305a2.106 2.106 0 0 0 4.212 0v-.043v.002v-4.263a2.112 2.112 0 0 0-2.104-2.106z" />
                                <path fill="currentColor" d="M16.263 2.631H12.21C11.719 1.094 10.303 0 8.631 0S5.544 1.094 5.06 2.604l-.007.027h-4a1.053 1.053 0 0 0 0 2.106h4.053c.268.899.85 1.635 1.615 2.096l.016.009c-2.871.867-4.929 3.48-4.947 6.577v5.528a1.753 1.753 0 0 0 1.736 1.737h1.422v-3a3.737 3.737 0 1 1 7.474 0v3h1.421a1.752 1.752 0 0 0 1.738-1.737v-5.474a6.855 6.855 0 0 0-4.899-6.567l-.048-.012a3.653 3.653 0 0 0 1.625-2.08l.007-.026h4.053a1.056 1.056 0 0 0 1.053-1.053a1.149 1.149 0 0 0-1.104-1.105h-.002zM8.631 5.84a2.106 2.106 0 1 1 2.106-2.106l.001.06c0 1.13-.916 2.046-2.046 2.046l-.063-.001h.003z" />
                            </svg>
                        </div>
                        <div class="w-3/4 border-0">
                            <Card >
                                <template #title>{{item.title}}</template>
                                <template #content>
                                    <p class="m-0">{{item.description}}</p>
                                </template>
                            </Card>
                        </div>
                       
                    </div>
                </div>
                <div class="flex justify-evenly align-middle text-start  mx-auto">
                        <div class="h-full flex justify-center align-middle my-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[40px]" viewBox="0 0 17 24">
                                <rect width="17" height="24" fill="none" />
                                <path fill="currentColor" d="M8.632 15.526a2.112 2.112 0 0 0-2.106 2.105v4.305a2.106 2.106 0 0 0 4.212 0v-.043v.002v-4.263a2.112 2.112 0 0 0-2.104-2.106z" />
                                <path fill="currentColor" d="M16.263 2.631H12.21C11.719 1.094 10.303 0 8.631 0S5.544 1.094 5.06 2.604l-.007.027h-4a1.053 1.053 0 0 0 0 2.106h4.053c.268.899.85 1.635 1.615 2.096l.016.009c-2.871.867-4.929 3.48-4.947 6.577v5.528a1.753 1.753 0 0 0 1.736 1.737h1.422v-3a3.737 3.737 0 1 1 7.474 0v3h1.421a1.752 1.752 0 0 0 1.738-1.737v-5.474a6.855 6.855 0 0 0-4.899-6.567l-.048-.012a3.653 3.653 0 0 0 1.625-2.08l.007-.026h4.053a1.056 1.056 0 0 0 1.053-1.053a1.149 1.149 0 0 0-1.104-1.105h-.002zM8.631 5.84a2.106 2.106 0 1 1 2.106-2.106l.001.06c0 1.13-.916 2.046-2.046 2.046l-.063-.001h.003z" />
                            </svg>
                        </div>
                        <Card>
                            <template #title>Quick Ride</template>
                            <template #content>
                                <p class="m-0">Request for a quick ride </p>
                            </template>
                        </Card>
                </div>
            </div>

        </Drawer>
        <!-- <Button icon="pi pi-arrow-right" @click="visible = true" /> -->
        <div  @click="visible = true" >
            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 512 512">
                <rect width="512" height="512" fill="none" />
                <path fill="currentColor" d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38c-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6M432 480H80a31 31 0 0 1-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75c1.94 10.73-.68 21.34-7.18 29.11A31 31 0 0 1 432 480" />
            </svg>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Drawer from "primevue/drawer"
import Card from 'primevue/card'
import RideIconVue from "./Icons/RideIcon.vue";
import ShoppingIconVue from "./Icons/ShoppingIcon.vue";
import PackageDeliveryIconVue from "./Icons/PackageDeliveryIcon.vue";
const visible = ref(false);
const items = [
    {
        icon:RideIconVue,
        title:'Quick Ride',
        description:'Request for a ride',
        link:'/transport',
    },
    {
        icon:ShoppingIconVue,
        title:'Shopping',
        description:'Shopping done for you',
        link:'/shopping',
    },
    {
        icon:PackageDeliveryIconVue,
        title:'Delivery',
        description:'We also deliver',
        link:'/delivery',
    },
    {
        icon:RideIconVue,
        title:'Logout',
        description:'Your profile',
        link:'/logout',
    },
    {
        icon:RideIconVue,
        title:'Register Rider',
        description:'Your profile',
        link:'/addRider',
    },
]
import store  from '../store/index'
import router from '../router/index'
function nextPage(item){
    if(item.link == '/logout'){
        store.dispatch('logout',store.state.user.data)
            .then(()=>{
                router.push('/')
            })
    }else if(item.link == '/addRider'){
        router.push('/addRider')
    }else if(item.link == '/shopping' || item.link == '/delivery' || item.link == '/transport'){
        router.push(item.link)
    }
    
}
</script>