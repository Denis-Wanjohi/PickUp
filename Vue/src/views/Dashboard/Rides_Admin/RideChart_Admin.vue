
<template>
    
   <div class="card h-[90%] p-3  " >
      <div class="w-full  flex justify-end">
         <div class="my-auto font-bold">Number of Rides</div>
         <Button label="Week" class="mx-2" @click="selectedTime('week')"></Button>
         <Button label="Month" class="mx-2" @click="selectedTime('month')"></Button>
         <Button label="Year" class="mx-2"  @click="selectedTime('year')"></Button>
      </div>
      <Chart  class="h-full" type="line" :data="chartData" :options="chartOptions" />
   </div>
</template>

<script setup>
import { ref, onMounted,watch } from "vue";
import Chart from 'primevue/chart';
import Button from 'primevue/button';
import store from "../../../store";
const data = ref() 
const ride_data = ref() 
const x_values = ref() 
const time_array = ref([])

onMounted(() => {
   data.value = [0, 0, 0, 0, 0, 0, 0,0,0,0,0,0] 
   x_values.value = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December']
   chartData.value = setChartData();
   chartOptions.value = setChartOptions();
});
watch(store.state.admin,()=>{
    ride_data.value = store.state.admin.rides
    if(ride_data.value != null){
        getData()
    }

})
function getData(){
    ride_data.value.forEach(element => {
        let dt = new Date(element.date)
        let date = {
            year:dt.getFullYear(),
            month:dt.getMonth(),
            date:dt.getDate()
        }
        time_array.value.push(date)
        date = {
            year:null,
            month:null,
            date:null
        }
    });
    selectedTime('year')
}
function selectedTime(time){
   if(time == 'week'){
      data.value = [0,0,0,0,0,0,0]
      x_values.value = ['','','','','','','']
    console.log(Math.floor(new Date().getDate() / 7) == 0)
    time_array.value.forEach(element=>{
        if(element.year == new Date().getFullYear()){
            if(element.month == new Date().getMonth()){
                if(Math.floor(element.date / 7) == Math.floor(new Date().getDate() / 7)){
                    console.log(new Date(element.year ,element.month, element.date))
                    data.value[new Date(element.year ,element.month, element.date).getDay()] += 1
                    x_values.value[new Date(element.year ,element.month, element.date).getDay()] = new Date(element.year ,element.month, element.date).getDate()
                }
            }
        }
    }) 
   }else if(time == 'month'){
    data.value = [0,0,0,0]
    time_array.value.forEach(element=>{
        if(element.year == new Date().getFullYear()){
            if(element.month == new Date().getMonth()){
                if(Math.floor(element.date / 7) == 4){
                    data.value[3] += 1
                }else{
                    data.value[Math.floor(element.date / 7)] += 1
                }
            }
        }
    })
    x_values.value = ['Week  1','Week 2','Week 3', 'Week 4']
   }else if(time = 'year'){
        let months = []
       time_array.value.forEach(element=>{
        if(element.year == new Date().getFullYear()){
            months.push(element.month) 
        }
       })
    months.sort()
    data.value = [0, 0, 0, 3, 0, 0, 0,0,0,0,0,0]
    for(let i = 0; i < data.value.length; i++){
        let count = 0
        months.forEach(element=>{
            if(element == i){
                count++
            }
        })
        data.value[i] = count
        count = 0
    } 
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
</script>

