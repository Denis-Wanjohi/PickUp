<template>
    <div>
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
    </div>
</template>

<script setup>
import DeliveryData from './DeliveryData.vue'
import RideData from './RideData.vue'
import ShoppingData from './ShoppingData.vue'

</script>