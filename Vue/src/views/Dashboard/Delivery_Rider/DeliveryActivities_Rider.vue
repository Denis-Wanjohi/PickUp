
<template>
    <div class="card">
        <div class="text-center text-xl font-bold">Delivery history(rider)</div>
        <DataTable stripedRows selectionMode="single" v-model:filters="filters" :value="customers" paginator showGridlines :rows="10" dataKey="id"
                filterDisplay="menu" :loading="loading" :globalFilterFields="['name', 'rider', 'location','destination','date','time']">
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

            <Column field="name" header="Client Name" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.name }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" placeholder="Search by name" />
                </template>
            </Column>

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
import { ref, onMounted } from 'vue';
// import { CustomerService } from '@/service/CustomerService';
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import Slider from 'primevue/slider';
import Checkbox from 'primevue/checkbox';
import ProgressBar from 'primevue/progressbar';
import Select from 'primevue/select';
import Tag from 'primevue/tag';
import InputNumber from 'primevue/inputnumber';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import DatePicker from 'primevue/datepicker';


const customers = ref();
const filters = ref();
const representatives = ref([
    { name: 'Amy Elsner', image: 'amyelsner.png' },
    { name: 'Anna Fali', image: 'annafali.png' },
    { name: 'Asiya Javayant', image: 'asiyajavayant.png' },
    { name: 'Bernardo Dominic', image: 'bernardodominic.png' },
    { name: 'Elwin Sharvill', image: 'elwinsharvill.png' },
    { name: 'Ioni Bowcher', image: 'ionibowcher.png' },
    { name: 'Ivan Magalhaes', image: 'ivanmagalhaes.png' },
    { name: 'Onyama Limba', image: 'onyamalimba.png' },
    { name: 'Stephen Shaw', image: 'stephenshaw.png' },
    { name: 'XuXue Feng', image: 'xuxuefeng.png' }
]);
const statuses = ref(['unqualified', 'qualified', 'new', 'negotiation', 'renewal', 'proposal']);
const loading = ref(true);

const CustomerService = {
    getCustomersMedium() {
        const customersData = [
        {
            id: 1000,
            name: 'Jamess But',
            rider:'Kim Kimani',
            location:'Town',
            destination:'Makutano',
            date: '2024-09-13',
            time:'1200h',
                   
        },
        {
            id: 1001,
            name: 'John Doe',
            rider: 'Jane Smith',
            location: 'City',
            destination: 'Suburbs',
            date: '2024-09-14',
            time: '1300h',
            activity: 45
            },
            {
            id: 1002,
            name: 'Jane Smith',
            rider: 'John Doe',
            location: 'Suburbs',
            destination: 'City',
            date: '2024-09-15',
            time: '1400h',
            activity: 56
            },
            {
            id: 1003,
            name: 'Bob Johnson',
            rider: 'Alice Brown',
            location: 'Town',
            destination: 'Village',
            date: '2024-09-16',
            time: '1500h',
            activity: 67
            },
            {
            id: 1004,
            name: 'Alice Brown',
            rider: 'Bob Johnson',
            location: 'Village',
            destination: 'Town',
            date: '2024-09-17',
            time: '1600h',
            activity: 78
            },
            {
            id: 1005,
            name: 'Mike Davis',
            rider: 'Emily Chen',
            location: 'City',
            destination: 'Suburbs',
            date: '2024-09-18',
            time: '1700h',
            activity: 89
            },
            {
            id: 1006,
            name: 'Emily Chen',
            rider: 'Mike Davis',
            location: 'Suburbs',
            destination: 'City',
            date: '2024-09-19',
            time: '1800h',
            activity: 90
            },
            {
            id: 1007,
            name: 'David Lee',
            rider: 'Sophia Patel',
            location: 'Town',
            destination: 'Makutano',
            date: '2024-09-20',
            time: '1900h',
            activity: 12
            },
            {
            id: 1008,
            name: 'Sophia Patel',
            rider: 'David Lee',
            location: 'Makutano',
            destination: 'Town',
            date: '2024-09-21',
            time: '2000h',
            activity: 23
            },
            {
            id: 1009,
            name: 'Kevin White',
            rider: 'Olivia Martin',
            location: 'City',
            destination: 'Suburbs',
            date: '2024-09-22',
            time: '2100h',
            activity: 34
            },
            {
            id: 1010,
            name: 'Olivia Martin',
            rider: 'Kevin White',
            location: 'Suburbs',
            destination: 'City',
            date: '2024-09-23',
            time: '2200h',
            activity: 45
            },
            {
            id: 1011,
            name: 'Peter Hall',
            rider: 'Ava Kim',
            location: 'Town',
            destination: 'Village',
            date: '2024-09-24',
            time: '2300h',
            activity: 56
            },
            {
            id: 1012,
            name: 'Ava Kim',
            rider: 'Peter Hall',
            location: 'Village',
            destination: 'Town',
            date: '2024-09-25',
            time: '2400h',
            activity: 67
            },
            {
            id: 1013,
            name: 'Samuel Brown',
            rider: 'Lily Chen',
            location: 'City',
            destination: 'Suburbs',
            date: '2024-09-26',
            time: '0100h',
            activity: 78
            },
            {
            id: 1014,
            name: 'Lily Chen',
            rider: 'Samuel Brown',
            location: 'Suburbs',
            destination: 'City',
            date: '2024-09-27',
            time: '0200h',
            activity: 89
            }

        ];

        return new Promise((resolve) => {
            setTimeout(() => resolve(customersData), 1000);
        });
    }
};

onMounted(() => {
    CustomerService.getCustomersMedium().then((data) => {
        customers.value = getCustomers(data);
        loading.value = false;
    });
});


const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        rider:{operator:FilterOperator .AND, constraints: [{value:null, matchMode:  FilterMatchMode.STARTS_WITH}]},
        location:{operator:FilterOperator .AND, constraints: [{value:null, matchMode:  FilterMatchMode.STARTS_WITH}]},
        destination:{operator:FilterOperator .AND, constraints:[{value:null, matchMedia: FilterMatchMode.STARTS_WITH}]},
        date: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.CONTAINS}] },
        balance: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] },
        status: { operator: FilterOperator.OR, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] },
        activity: { value: [0, 100], matchMode: FilterMatchMode.BETWEEN },
        verified: { value: null, matchMode: FilterMatchMode.EQUALS }
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
const formatCurrency = (value) => {
    return value.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
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
const getSeverity = (status) => {
    switch (status) {
        case 'unqualified':
            return 'danger';

        case 'qualified':
            return 'success';

        case 'new':
            return 'info';

        case 'negotiation':
            return 'warn';

        case 'renewal':
            return null;
    }
};
</script>




















