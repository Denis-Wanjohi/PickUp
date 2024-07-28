<template>

        <div class="card w-[90%] h-full border mx-3">
          
            <div class="flex flex-wrap items-center justify-between gap-2 py-4">
                <span class="text-xl font-bold">Recent Activities</span>
                <Button icon="pi pi-refresh" rounded raised />
            </div>
            <DataTable :value="products" removableSort size="small" tableStyle="min-width: 50rem">
                <Column field="activity" sortable header="Activity"></Column>
                <Column field="rider" sortable header="Rider"></Column>
                <Column field="client" sortable header="Client"></Column>
                <Column field="time" sortable header="Time"></Column>
            </DataTable>
        </div>
        
    
</template>

<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button'
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import { ref, onMounted } from 'vue';

const products = ref([]);

onMounted(() => {
    const mockData = [
        { activity: 'shopping', rider: 'Tom', client: 'KImani kim 1', time: '10:00pm' },
        { activity: 'rider', rider: 'Tom', client: 'KImani kim 1', time: '10:00am' },
        { activity: 'package delivery', rider: 'Jerry', client: 'KImani kim 1', time: '9:00pm' },
        { activity: 'shopping', rider: 'Tommy', client: 'KImani kim 1', time: '1:00pm' },
        { activity: 'rider', rider: 'Jammy', client: 'KImani kim 1', time: '4:00pm' },
        { activity: 'shopping', rider: 'Tim', client: 'KImani kim 1', time: '3:00pm' },
        
        // Add more products as needed
    ];
    products.value = mockData;
});
</script>
