
<template>
    <div class="card">
        <div class="text-center text-xl font-bold">Delivery history(client)</div>
        <DataTable stripedRows selectionMode="single" v-model:filters="filters" :value="customers" paginator showGridlines :rows="10" dataKey="id"
                filterDisplay="menu" :loading="loading" :globalFilterFields="['rider', 'location','destination','weight','date','time']">
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

            <!-- RIDER NAME -->
            <Column header="Rider" filterField="rider" style="min-width: 12rem">
                <template #body="{ data }">
                    <div class="flex items-center gap-2">
                        <!-- <img alt="flag" src="https://primefaces.org/cdn/primevue/images/flag/flag_placeholder.png" :class="`flag flag-${data.country.code}`" style="width: 24px" /> -->
                        <span>{{ data.rider }}</span>
                    </div>
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" placeholder="Rider name" />
                </template>
                <template #filterclear="{ filterCallback }">
                    <Button type="button" icon="pi pi-times" label="cancel" @click="filterCallback()" severity="secondary"></Button>
                </template>
                <template #filterapply="{ filterCallback }">
                    <Button type="button" icon="pi pi-check" label="apply" @click="filterCallback()" severity="success"></Button>
                </template>
                <template #filterfooter>
                    <div class="px-4 pt-0 pb-4 text-center">Customized Buttons</div>
                </template>
            </Column>

            <!-- LOCATION -->
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

            <!-- DESTINATION -->
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

            <!-- PICKUP TIME -->
            <Column header="Time" filterField="time" dataType="numeric" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ data.time }}
                </template>
                <template #filter="{ filterModel }">
                    <InputNumber v-model="filterModel.value" mode="currency" currency="USD" locale="en-US" />
                </template>
            </Column>

            <!-- DATE -->
            <Column header="Date" filterField="date" dataType="date" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ dateFormatter(data.date )}}
                </template>
                <template #filter="{ filterModel }">
                    <DatePicker v-model="filterModel.value" dateFormat="mm/dd/yy" placeholder="mm/dd/yyyy" />
                </template>
            </Column>

            <Column header="Weight" filterField="weight" dataType="numeric" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ data.weight }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" placeholder="weight"></InputText>
                </template>
            </Column>

        </DataTable>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
// import { CustomerService } from '@/service/CustomerService';
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputNumber from 'primevue/inputnumber';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import DatePicker from 'primevue/datepicker';
import store from '../../../store'
const data = ref(store.state.user.packages)
// location destination rider weight pickuptime when
const customers = ref();
const filters = ref();
const loading = ref(true);
const customersData = ref([])

const CustomerService = {
    getCustomersMedium() {
        if(data.value.length != 0){
            data.value.forEach(element => {
                customersData.value.push(
                    {
                        rider:element.rider,
                        location:element.location,
                        destination:element.destination,
                        date:dateFormatter(element.created_at),
                        time:timeFormatter(element.time),
                        weight:element.weight,
                    }
                )
            });
        }
        return new Promise((resolve) => {
            setTimeout(() => resolve(customersData.value), 1000);
        });
    }
};

onMounted(() => {
    getData()
});

watch(()=>store.state.user.packages,()=>{
    data.value = store.state.user.packages
    console.log(data.value)
    getData()
})

function getData(){
    CustomerService.getCustomersMedium().then((data) => {
        customers.value = getCustomers(data);
        loading.value = false;
    });
}
function dateFormatter(date){
    let pass_date  =  new Date(date)
    let month = (Number(pass_date.getMonth()) + 1).toString()
    month = month.length == 1 ? "0"+month : month
    let day = pass_date.getDate().toString().length == 1 ? "0"+pass_date.getDate() : pass_date.getDate()
    return pass_date.getFullYear() + "-" + month   + "-" + day
}
function timeFormatter(date){
    let pass_date  =  new Date(date)
    let hour = pass_date.getHours().toString().length == 1 ? "0"+pass_date.getHours() : pass_date.getHours()
    let minutes = pass_date.getMinutes().toString().length == 1 ? "0"+pass_date.getMinutes() : pass_date.getMinutes()
    return  hour+ ":" + minutes 
}
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        rider:{operator:FilterOperator .AND, constraints: [{value:null, matchMode:  FilterMatchMode.STARTS_WITH}]},
        location:{operator:FilterOperator .AND, constraints: [{value:null, matchMode:  FilterMatchMode.STARTS_WITH}]},
        destination:{operator:FilterOperator .AND, constraints:[{value:null, matchMedia: FilterMatchMode.STARTS_WITH}]},
        date: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS}] },
        time: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS}] },
        weight: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS}] },
    };
};

initFilters();

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




















