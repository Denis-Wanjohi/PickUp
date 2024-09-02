
<template>
    <div class="card h-[90%] p-3" >
       <div class="w-full  flex justify-end">
          <div class="my-auto font-bold">Number of Rides</div>
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
     console.log(arr_months.value)
       data.value = [2,8,5,3,6,8,10]
       x_values.value = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']
    }else if(time == 'month'){
       data.value = [1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4]
       x_values.value = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
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
     let month = (Number(pass_date.getMonth()) + 1).toString()
     month = month.length == 1 ? "0"+month : month
     let day = pass_date.getDate().toString().length == 1 ? "0"+pass_date.getDate() : pass_date.getDate()
     return pass_date.getFullYear() + "-" + month   + "-" + day
 }
 </script>
 
 