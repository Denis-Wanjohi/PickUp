
<template>
    <div class="card">
        <div class="text-center text-xl font-bold">Shopping history(client)</div>

        <DataTable removableSort scrollable  :value="orders" v-model:expandedRows="expandedRows"  v-model:filters="filters" @rowExpand="onRowExpand" @rowCollapse="onRowCollapse"
            :globalFilterFields="['orderNo','clinet_name','rider_name','destination','date','time','total','phone_number']"
        >
            <template #header>
                <div class="flex justify-end">
                    <InputText v-model="filters['global'].value"  placeholder="Keyword search"></InputText>
                    <Button type="button" label="Clear" outlined @click="clearFilter()"></Button>
                </div>
            </template>
            <Column expander style="width:2rem"></Column>
            <Column field="orderNo" sortable  frozen  header="Order No."></Column>
            <Column field="client_name" sortable header="Client"></Column>
            <Column field="rider_name" sortable header="Rider"></Column>
            <Column field="destination" sortable header="Destination"></Column>
            <Column field="date" sortable header="Date"></Column>
            <Column field="time" sortable header="Time"></Column>
            <Column field="total" sortable header="Total">
                <template #body={data}>
                    <div>
                       Ksh. {{ data.total }}
                        <!-- {{ formatCurrency(data.total) }} -->
                    </div>
                </template>
            </Column>
            <Column field="phone_number" sortable header="Phone Number"></Column>
            <template #expansion="slotProps">
                <div  class="p-4">
                    <DataTable :value="slotProps.data.cart">
                        <Column sortable header="Product" field="product_name"></Column>
                        <Column sortable header="Qunatity" field="quantity"></Column>
                        <Column sortable header="Price" field="price">
                            <template #body={data}>
                                <div>
                                    Ksh. {{ data.price }}
                                    <!-- {{ formatCurrency(data.price) }} -->
                                </div>
                            </template>
                        </Column>
                        <Column sortable header="Company" field="company"></Column>
                        <Column sortable header="Shop" field="shop"></Column>
                        <Column sortable header="Info" field="extra_info"></Column>
                    </DataTable>
                </div>
            </template>
        </DataTable>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import {FilterMatchMode,FilterOperator} from '@primevue/core/api'
const filters = ref();

const orders = ref()

onMounted(()=>{
    orders.value = [
        {
            orderNo:29,
            client_name:'Jerry',
            rider_name:'Tom',
            destination:'Kinoru',
            date:'2023-09-12',
            time:'1400h',
            total:500,
            phone_number:'+254723892001',
            cart:[
                {
                    product_name:'Kebab',
                    quantity:'1',
                    price:'80',
                    company:'any',
                    shop:'Sayen',
                    extra_info:'Pick the hot one please'
                },
                {
                    product_name: "Pizza",
                    quantity: "2",
                    price: "120",
                    company: "Pizza Hut",
                    shop: "Westlands",
                    extra_info: "Add extra cheese"
                },
                {
                    product_name: "Burger",
                    quantity: "3",
                    price: "100",
                    company: "Burger King",
                    shop: "Nyali",
                    extra_info: "No pickles"
                }
            ]
        },
        {
            orderNo: 30,
            client_name: "John",
            rider_name: "Doe",
            destination: "Nairobi",
            date: "2023-09-13",
            time: "1500h",
            total: 600,
            phone_number: "+254723892002",
            cart: [
                {
                product_name: "Pizza",
                quantity: "2",
                price: "120",
                company: "Pizza Hut",
                shop: "Westlands",
                extra_info: "Add extra cheese"
                },
                {
                product_name: "Burger",
                quantity: "3",
                price: "100",
                company: "Burger King",
                shop: "Nyali",
                extra_info: "No pickles"
                }
            ]
        },
        {
            orderNo: 31,
            client_name: "Jane",
            rider_name: "Smith",
            destination: "Mombasa",
            date: "2023-09-14",
            time: "1600h",
            total: 700,
            phone_number: "+254723892003",
            cart: [
                {
                product_name: "Burger",
                quantity: "3",
                price: "100",
                company: "Burger King",
                shop: "Nyali",
                extra_info: "No pickles"
                }
            ]
        },
        {
            orderNo: 32,
            client_name: "Bob",
            rider_name: "Johnson",
            destination: "Kisumu",
            date: "2023-09-15",
            time: "1700h",
            total: 800,
            phone_number: "+254723892004",
            cart: [
                {
                product_name: "Fries",
                quantity: "4",
                price: "60",
                company: "KFC",
                shop: "Kisumu Mall",
                extra_info: "Add ketchup"
                }
            ]
        },
        {
            orderNo: 33,
            client_name: "Alice",
            rider_name: "Williams",
            destination: "Eldoret",
            date: "2023-09-16",
            time: "1800h",
            total: 900,
            phone_number: "+254723892005",
            cart: [
                {
                product_name: "Chicken",
                quantity: "5",
                price: "140",
                company: "Chicken Inn",
                shop: "Eldoret Mall",
                extra_info: "No sauce"
                }
            ]
        }
    ]
})


const initFilters = ()=>{
    filters.value = {
        global:{value:null, matchMode:FilterMatchMode.CONTAINS}
    }
}

initFilters()
function clearFilter(){
    initFilters()
}
const formatCurrency = (value) => {
    return value.toLocaleString('en-KE', { style: 'currency', currency: 'KES' });
};
</script>




















