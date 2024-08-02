
<template>
    <div class="w-screen">
        <div class="text-center font-bold text-4xl py-3">SHOPPING ANALYSIS(client)</div>
        <Splitter class="max-h-[400px]  px-5 mx-5">
            <SplitterPanel class="overflow-y-scroll">
                <ShoppingActivities></ShoppingActivities> 
            </SplitterPanel>
            <SplitterPanel>
                <ShoppingChart></ShoppingChart>
            </SplitterPanel>
        </Splitter>



    </div>
</template>
<script setup>
import ShoppingActivities from '../Shopping_Client/ShoppingActivities_Client.vue'
import ShoppingChart from '../Shopping_Client/ShoppingChart_Client.vue'
import Splitter from 'primevue/splitter'
import SplitterPanel from 'primevue/splitterpanel'
</script>