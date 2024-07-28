
<template>
    <div class="w-screen ">
        <div class="text-center font-bold text-xl">RIDES ANALYSIS</div>
        <Splitter class="max-h-[400px]  px-5 mx-5">
            <SplitterPanel class="overflow-y-scroll">
                <RideActivities></RideActivities> 
            </SplitterPanel>
            <SplitterPanel>
                <RideChart></RideChart>
            </SplitterPanel>
        </Splitter>
    </div>
</template>

<script setup>
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';
import RideActivities from './RideActivities_Admin.vue';
import RideChart from './RideChart_Admin.vue';



</script>
