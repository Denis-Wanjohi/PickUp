
<template>
    <div class="w-screen ">
        <div class="text-center font-bold text-4xl py-3">DELIVERY ANALYSIS(Rider)</div>
        <Splitter class="max-h-[400px]  px-5 mx-5">
            <SplitterPanel class="overflow-y-scroll">
                <DeliveryActivities></DeliveryActivities> 
            </SplitterPanel>
            <SplitterPanel>
                <DeliveryChart></DeliveryChart>
            </SplitterPanel>
        </Splitter>
    </div>
</template>

<script setup>
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';
import DeliveryActivities from './DeliveryActivities_Rider.vue';
import DeliveryChart from './DeliveryChart_Rider.vue';



</script>
