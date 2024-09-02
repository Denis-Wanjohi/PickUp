
<template>
    <div class="card">
        <div class="text-center text-xl font-bold">Rides history</div>
        <DataTable stripedRows scrollable  v-model:filters="filters" :value="customers" paginator showGridlines :rows="10" dataKey="id"
                filterDisplay="menu" :loading="loading" :globalFilterFields="['rider', 'location','destination','date','time']">
            <template #header>
                <div class="flex justify-between">
                    <Button type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                    <IconField>
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                    </IconField>
                </div>
            </template>
            <template #empty> No customers found. </template>
            <template #loading> Loading customers data. Please wait. </template>

            <Column field="rider" header="Rider Name"   frozen style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.rider }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                </template>
            </Column>



            <Column header="Location" filterField="location" :showFilterMatchModes="true" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                <template #body="{data}">
                    <div class="flex items-center gap-2">
                        <span>{{ data.location }}</span>
                    </div>
                </template>
                <template   #filter="{filterModel}" class="text-red">
                    <InputText v-model="filterModel.value" type="text"placeholder="location"></InputText>
                </template>
            </Column>

            <Column header="Destination" filterField="destination" :showFilterMatchModes="true" :filterMenuStyle="{ width: '14rem' }" style="min-width: 14rem">
                <template #body="{data}">
                    <div>
                        {{ data.destination }} 
                    </div>
                </template>
                <template #filter="{filterModel}">
                    <InputText v-model="filterModel.value" type="text" placeholder="destination"></InputText>
                </template>
            </Column>

            <Column header="Date" filterField="date" dataType="date" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ formatDate(data.date) }}
                </template>
                <template #filter="{ filterModel }">
                    <DatePicker v-model="filterModel.value" dateFormat="mm/dd/yy" placeholder="mm/dd/yyyy" />
                </template>
            </Column>

            <Column header="Time" filterField="balance" dataType="numeric" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ data.time }}
                </template>
                <template #filter="{ filterModel }">
                    <InputNumber v-model="filterModel.value" mode="currency" currency="USD" locale="en-US" />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';

import { FilterMatchMode, FilterOperator } from '@primevue/core/api';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputNumber from 'primevue/inputnumber';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import DatePicker from 'primevue/datepicker';
import store from '../../../store/index'
const data = ref([])
const rides = ref(store.state.user.rides)
const customersData = ref([])
const customers = ref();
const filters = ref();
const statuses = ref(['unqualified', 'qualified', 'new', 'negotiation', 'renewal', 'proposal']);
const loading = ref(true);

// watch(rides=>{
//     data.value = []
//     if(store.state.user.rides.length != 0){

//         store.state.user.rides.forEach((el)=>{
//             el.created_at = dateFormatter(el.created_at)
//             customersData.value.push(el)
//             getData()
//         })
//     }
// })
watch(rides=>{
    customersData.value  = []
    if(store.state.user.rides.length != 0){
        store.state.user.rides.forEach((el)=>{
            el.date = dateFormatter(el.created_at)
            customersData.value.push(el)
        })
        getData()
    }
})
function dateFormatter(date){
    let pass_date  =  new Date(date)
    let month = (Number(pass_date.getMonth()) + 1).toString()
    month = month.length == 1 ? "0"+month : month
    let day = pass_date.getDate().toString().length == 1 ? "0"+pass_date.getDate() : pass_date.getDate()
    return pass_date.getFullYear() + "-" + month   + "-" + day
}


const CustomerService = {
    getCustomersMedium() {
     customersData.value = store.state.user.rides
        return new Promise((resolve) => {
            setTimeout(() => resolve(customersData), 1000);
        });
    }
};

onMounted(() => {
    getData()
});

function getData(){
        CustomerService.getCustomersMedium().then((data) => {
            customers.value = getCustomers(data.value);
            loading.value = false;
        });
}


const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        payment:{operator:FilterOperator .AND, constraints: [{value:null, matchMode:  FilterMatchMode.STARTS_WITH}]},
        location:{operator:FilterOperator .AND, constraints: [{value:null, matchMode:  FilterMatchMode.STARTS_WITH}]},
        destination:{operator:FilterOperator .AND, constraints:[{value:null, matchMedia: FilterMatchMode.STARTS_WITH}]},
        date: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS}] },
    };
};

initFilters();

const formatDate = (value) => {
    return value.toLocaleDateString('en-US', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
};

const clearFilter = () => {
    initFilters();
};
const getCustomers = (data) => {
    return [...(data || [])].map((d) => {
        d.date = new Date(d.date);

        return d;
    });
};
</script>



