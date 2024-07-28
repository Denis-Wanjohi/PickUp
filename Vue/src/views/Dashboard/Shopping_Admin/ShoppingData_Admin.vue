
<template>
    <div class="w-screen ">
        <div class="text-center font-bold text-xl">RIDES ANALYSIS</div>
        <!-- <Splitter class="max-h-[400px]  px-5 mx-5">
            <SplitterPanel class="overflow-y-scroll">
                <ShoppingActivities></ShoppingActivities> 
            </SplitterPanel>
            <SplitterPanel>
                <ShoppingChart></ShoppingChart>
            </SplitterPanel>
        </Splitter> -->


        <DataTable  :value="orders" v-model:expandedRows="expandedRows" @rowExpand="onRowExpand" @rowCollapse="onRowCollapse">
            <Column expander style="width:2rem"></Column>
            <Column field="orderNo" header="Order No."></Column>
            <Column field="client_name" header="Client"></Column>
            <Column field="rider_name" header="Rider"></Column>
            <Column field="destination" header="Destination"></Column>
            <Column field="date" header="Date"></Column>
            <Column field="time" header="Time"></Column>
            <Column field="total" header="Total"></Column>
            <Column field="phone_number" header="Phone Number"></Column>
            <template #expansion="slotProps">
                <div  class="p-4">
                    <DataTable :value="slotProps.data.cart">
                        <Column header="Product" field="product_name"></Column>
                        <Column header="Qunatity" field="quantity"></Column>
                        <Column header="Price" field="price"></Column>
                        <Column header="Company" field="company"></Column>
                        <Column header="Shop" field="shop"></Column>
                        <Column header="Info" field="extra_info"></Column>
                    </DataTable>
                </div>
            </template>
        </DataTable>
    </div>
</template>

<script setup>
import Splitter from 'primevue/splitter';
import SplitterPanel from 'primevue/splitterpanel';
import ShoppingActivities from './ShoppingActivities_Admin.vue';
import ShoppingChart from './ShoppingChart_Admin.vue';
import {onMounted, ref} from 'vue'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
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

</script>
