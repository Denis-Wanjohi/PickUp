<script>
import {ref } from 'vue'
import Home from './layout/Home.vue'


const count = ref(0)
export default{
    components:{
        Home
    }
}
</script>

<template>
    <div>
        <Home/>
    </div>
</template>
