
<template>
   <div class="card h-[90%] p-3  " >
      <div class="w-full  flex justify-end">
         <div class="my-auto font-bold">Number of Rides(client)</div>
         <Button label="Week" class="mx-2" @click="selectedTime('week')"></Button>
         <Button label="Month" class="mx-2" @click="selectedTime('month')"></Button>
         <Button label="Year" class="mx-2"  @click="selectedTime('year')"></Button>
      </div>
      <!-- <Chart  class="h-full" type="line" :data="chartData" :options="chartOptions" /> -->
      <Chart type="bar" :data="chartData" :options="chartOptions" class="h-[30rem]"  />

   </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Chart from 'primevue/chart';
import Button from 'primevue/button';
const data = ref() 
const x_values = ref() 
// alert(data.value)

onMounted(() => {
   data.value = [12, 51, 62, 33, 21, 62, 45,22,23,45,47,5] 
   x_values.value = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December']
   chartData.value = setChartData();
   chartOptions.value = setChartOptions();
});

function selectedTime(time){
   if(time == 'week'){
      data.value = [2,8,5,3,6,8,10]
      x_values.value = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
   }else if(time == 'month'){
      data.value = [12,30,24,19]
      x_values.value = ['Week  1','Week 2','Week 3', 'Week 4']
   }else if(time = 'year'){
      data.value = [12, 51, 62, 33, 21, 62, 45,22,23,45,47,5] 
      x_values.value = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December']
   }
   chartData.value = setChartData();
   chartOptions.value = setChartOptions();
}
const chartData = ref();
const chartOptions = ref();
       
const setChartData = () => {
   const documentStyle = getComputedStyle(document.documentElement);
   return {
       labels: x_values.value,
       datasets: [
           {
               label: 'Rides',
               data: data.value,
               fill: true,
               borderDash: [5, 5],
               borderColor: documentStyle.getPropertyValue('--p-orange-500'),
               tension: 0.4,
               backgroundColor: 'rgba(107, 114, 128, 0.2)'
           }
       ]
   };
};
const setChartOptions = () => {
   const documentStyle = getComputedStyle(document.documentElement);
   const textColor = documentStyle.getPropertyValue('--p-text-color');
   const textColorSecondary = documentStyle.getPropertyValue('--p-text-muted-color');
   const surfaceBorder = documentStyle.getPropertyValue('--p-content-border-color');

   return {
       indexAxis: 'y',
       maintainAspectRatio: false,
       aspectRatio: 0.6,
       plugins: {
           legend: {
               labels: {
                   color: textColor
               }
           }
       },
       scales: {
           x: {
               ticks: {
                   color: textColorSecondary
               },
               grid: {
                   color: surfaceBorder
               }
           },
           y: {
               ticks: {
                   color: textColorSecondary
               },
               grid: {
                   color: surfaceBorder
               }
           }
       }
   };
}
</script>

