
<template>
    {{ data}} 
   <div class="card h-[90%] p-3" >
      <div class="w-full  flex justify-end">
         <div class="my-auto font-bold">Number of Rides(client)</div>

         <Button label="Week" class="mx-2" @click="selectedTime('week')"></Button>
         <Button label="Month" class="mx-2" @click="selectedTime('month')"></Button>
         <Button label="Year" class="mx-2"  @click="selectedTime('year')"></Button>
      </div>
      <Chart  class="h-full" type="bar" :data="chartData" :options="chartOptions" />
   </div>
</template>

<script setup>
import { ref, onMounted, watch,computed } from "vue";
import Chart from 'primevue/chart';
import Button from 'primevue/button';
import store from '../../../store/index'
const data = ref([]) 
const x_values = ref() 
const dates  = ref(store.state.user.rides)
const arr_dates = ref([])
const arr_months = ref([])
const arr_months_count = ref([])

watch(()=>store.state.user.rides,(newValue)=>{
    arr_months.value = []
    data.value = []
    arr_months_count.value = []
     if(newValue.length != 0){
         newValue.forEach(element => {
             let dd = new Date(element.created_at)         
             arr_months.value.push(dd.getMonth())
         }); 
         let count = 0
         for(let i = 0; i < 12; i++){
             arr_months.value.sort().forEach((el)=>{
                 if(i == el){
                     count++
                 }
             })
             arr_months_count.value.push(count)
             count = 0
         }

     }
})



onMounted(() => {
    data.value = arr_months_count.value
      x_values.value = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December']
   chartData.value = setChartData();
   chartOptions.value = setChartOptions();
   setTimeout(() => {
    selectedTime('year')
   }, 3000);
});

function selectedTime(time){
   if(time == 'week'){
      data.value = [2,8,5,3,6,8,10]
      x_values.value = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
   }else if(time == 'month'){
      data.value = [12,30,24,19]
      x_values.value = ['Week  1','Week 2','Week 3', 'Week 4']
   }else if(time = 'year'){
      data.value = arr_months_count.value
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
function chart_dates(date){
    console.log(arr_dates.value)
}
function dateFormatter(date){
    let pass_date  =  new Date(date)
    // chart_dates(pass_date.getDate())
    // arr_dates.value.push(pass_date.getDate())
    let month = pass_date.getMonth().length != 1 ? "0"+pass_date.getMonth() : pass_date.getMonth()
    // console.log((pass_date.getDate().toString().length))
    let day = pass_date.getDate().toString().length == 1 ? "0"+pass_date.getDate() : pass_date.getDate()
    return pass_date.getFullYear() + "-" + month+ "-" + day
}
</script>

