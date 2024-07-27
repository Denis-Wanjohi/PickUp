
<template>
    <div class="card h-[50vh]">
        
        <div class="flex flex-wrap items-center justify-between gap-2  py-2">
            <span class="text-xl font-bold">Weekly data</span>
            <Button icon="pi pi-refresh" rounded raised />
        </div>
        <div>
             {{ date }}
        </div>
       
        <Chart type="bar" :data="chartData" :options="chartOptions" class="h-[75%]"/>
        <!-- {{ date }} <br> -->
       
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Chart from 'primevue/chart';

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});
const date  = ref(new Date()) 

setInterval(()=>{
    date.value  = new Date()
},1000)

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['Mon', 'Tue', 'Wen', 'Thur', 'Fri', 'Sat', 'Sun'],
        datasets: [
            {
                label: 'Rides',
                backgroundColor: documentStyle.getPropertyValue('--p-cyan-500'),
                borderColor: documentStyle.getPropertyValue('--p-cyan-500'),
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: 'Shopping',
                backgroundColor: documentStyle.getPropertyValue('--p-red-500'),
                borderColor: documentStyle.getPropertyValue('--p-gray-500'),
                data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: 'Deliveries',
                backgroundColor: documentStyle.getPropertyValue('--p-amber-500'),
                borderColor: documentStyle.getPropertyValue('--p-cyan-500'),
                data: [12, 38, 20, 59, 16, 47, 60]
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
        aspectRatio: 0.8,
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
                    color: textColorSecondary,
                    font: {
                        weight: 500
                    }
                },
                grid: {
                    display: false,
                    drawBorder: false
                }
            },
            y: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder,
                    drawBorder: false
                }
            }
        }
    };
}
</script>
