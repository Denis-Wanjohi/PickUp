
<template>
    <div class="card">
        <div class="text-center text-xl font-bold">Shopping history(client)</div>
        <DataTable removableSort scrollable  :value="orders" v-model:expandedRows="expandedRows"  v-nodel:filters="filters" @rowExpand="onRowExpand" @rowCollapse="onRowCollapse"
            :globalFilterFields="['orderNo','clinet_name','rider_name','destination','date','time','total','phone_number']"
        >
            <template #header>
                <div class="flex justify-end">
                    <InputText v-model="filters['global'].value"  placeholder="Keyword search"></InputText>
                    <Button type="button" label="Clear" outlined @click="clearFilter()"></Button>
                </div>
            </template>
            <Column expander style="width:2rem"/>
            <Column field="orderNo" sortable  frozen  header="Order No."></Column>
            <Column field="rider_name" sortable header="Rider"></Column>
            <Column field="destination" sortable header="Destination"></Column>
            <Column field="date" sortable header="Date"></Column>
            <!-- <Column field="time" sortable header="Time"></Column> -->
            <!-- <Column field="total" sortable header="Total">
                <template #body={data}>
                    <div>
                       Ksh. {{ data.total }}
                    </div>
                </template>
            </Column> -->
            <Column field="phone_number" sortable header="Phone Number"></Column>
            <template #expansion="slotProps">
                <div  class="p-4">
                    <DataTable :value="slotProps.data.cart">
                        <Column sortable header="Product" field="product_name"></Column>
                        <Column sortable header="Qunatity" field="quantity"></Column>
                        <!-- <Column sortable header="Price" field="price">
                            <template #body={data}>
                                <div>
                                    Ksh. {{ data.price }}
                                </div>
                            </template>
                        </Column> -->
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
import {onMounted, ref, watch} from 'vue'
const expandedRows = ref([]);
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import {FilterMatchMode} from '@primevue/core/api'
import store from '../../../store'
const data = ref(store.state.user.shopping)
const filters = ref();
console.log(data.value)
const orders = ref([])
watch(()=>store.state.user.shopping,()=>{
    data.value = store.state.user.shopping
    console.log(data.value) 
    if(data.value.length != 0){
            data.value.forEach(element => {
                orders.value.push({
                    orderNo:element.id,
                    rider_name:element.rider,
                    destination:element.location,
                    date: dateFormatter(element.created_at),
                    phone_number:element.phone,
                    cart: cartItems(JSON.parse(element.products)),
                })
                
            });
    }

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
function cartItems(data){
    let cart = {}
    let arr = []
    console.log(data.length)
    for(let  i = 0;i < data.length;i++){
        console.log(data[i])
        cart.product_name = data[i].product;
        cart.quantity = data[i].quantity;
        cart.company = data[i].company;
        cart.shop = data[i].shop;
        cart.extra_info = data[i].info;
        arr.push(cart)
        cart = {}
    }
    return arr
}
function dateFormatter(date){
    let pass_date  =  new Date(date)
    let month = (Number(pass_date.getMonth()) + 1).toString()
    month = month.length == 1 ? "0"+month : month
    let day = pass_date.getDate().toString().length == 1 ? "0"+pass_date.getDate() : pass_date.getDate()
    return pass_date.getFullYear() + "-" + month   + "-" + day
}
const formatCurrency = (value) => {
    return value.toLocaleString('en-KE', { style: 'currency', currency: 'KES' });
};
</script>




















