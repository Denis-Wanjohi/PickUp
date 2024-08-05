<template>
  <div class="  h-screen pb-5">
    <Toast/>
    <div class="sm:w-1/2 w-full  px-5 border border-white m-auto">
            <form  class="border-b  border-gray-900/10 pb-12" @submit.prevent="addToCart">
                <h2 class=" text-2xl pt-5 font-semibold leading-7 text-gray-900 text-center">SHOPPING</h2>
                <!-- <p class="mt-1 text-sm leading-6 text-gray-400 text-center">Incase of any inquiry please reach out to us through this form.Thank you  :)</p> -->
                <!-- <p class="mt-1 text-sm leading-6 text-gray-400 text-center">Please fill in correct details*</p> -->


                <div v-if="!isFormFilled" class="mt-10  grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 place-items-center">

                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="product" required v-model="product.product" />
                        <label for="product">Product Name</label>
                    </FloatLabel>
                    </div>

                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="quantity" type="number" required v-model="product.quantity" />
                        <label for="quantity">Quantity</label>
                    </FloatLabel>
                    </div>

                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <Select v-model="product.type" :options="types" optionLabel="name" placeholder="type" class="w-full md:w-56" />
                        <label for="type">Quantity in :</label>
                    </FloatLabel>
                    </div>

                    
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="company" required v-model="product.company" />
                        <label for="company">Company</label>
                    </FloatLabel>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="shop" required v-model="product.shop" />
                        <label for="shop">Shop</label>
                    </FloatLabel>
                    </div>

                    <!-- Extra info -->
                    <div class="sm:col-span-6  w-full px-10 ">
                    <FloatLabel>
                        <Textarea v-model="product.info" class="w-[100%]" />
                        <label>Extra information</label>
                    </FloatLabel>
                    </div>

                    <button class="py-3 bg-blue rounded-md sm:col-span-6 w-3/4 font-semibold mx-auto" @click="submitted" >
                        <v-progress-circular indeterminate v-if="submittedForm"></v-progress-circular>
                        <span v-else>submit</span>
                    </button>
                </div>

                <!-- submitting -->
                <div v-if="submitting" class="bg-blue-500 mx-auto sm:w-full sm:h-fit rounded text-center">
                    <div class="w-full ">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="200px" height="200px" viewBox="0 0 24 24">
                        <rect width="10" height="10" x="1" y="1" fill="blue" rx="1">
                            <animate id="svgSpinnersBlocksShuffle30" fill="freeze" attributeName="x" begin="0;svgSpinnersBlocksShuffle3b.end" dur="0.15s" values="1;13" />
                            <animate id="svgSpinnersBlocksShuffle31" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle38.end" dur="0.15s" values="1;13" />
                            <animate id="svgSpinnersBlocksShuffle32" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle39.end" dur="0.15s" values="13;1" />
                            <animate id="svgSpinnersBlocksShuffle33" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle3a.end" dur="0.15s" values="13;1" />
                        </rect>
                        <rect width="10" height="10" x="1" y="13" fill="orange" rx="1">
                            <animate id="svgSpinnersBlocksShuffle34" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle30.end" dur="0.15s" values="13;1" />
                            <animate id="svgSpinnersBlocksShuffle35" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle31.end" dur="0.15s" values="1;13" />
                            <animate id="svgSpinnersBlocksShuffle36" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle32.end" dur="0.15s" values="1;13" />
                            <animate id="svgSpinnersBlocksShuffle37" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle33.end" dur="0.15s" values="13;1" />
                        </rect>
                        <rect width="10" height="10" x="13" y="13"  fill="brown" rx="1">
                            <animate id="svgSpinnersBlocksShuffle38" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle34.end" dur="0.15s" values="13;1" />
                            <animate id="svgSpinnersBlocksShuffle39" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle35.end" dur="0.15s" values="13;1" />
                            <animate id="svgSpinnersBlocksShuffle3a" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle36.end" dur="0.15s" values="1;13" />
                            <animate id="svgSpinnersBlocksShuffle3b" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle37.end" dur="0.15s" values="1;13" />
                        </rect>
                        </svg>
                    </div>
                    <div class="font-mono text-3xl text-center">Submitting ....</div>
                </div>
                <!-- email sent -->
                <div v-if="emailSent" class="bg-blue-500 mx-auto sm:full sm:h-fit rounded text-center">
                    <div class="w-full ">
                        <svg class="mx-auto"  xmlns="http://www.w3.org/2000/svg" width="200px" height="200px" viewBox="0 0 24 24">
                        <g stroke="orange" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <circle cx="12" cy="12" r="9" fill="blue" fill-opacity="0.3" />
                            <path fill="none" stroke-dasharray="14" stroke-dashoffset="14" d="M8 12L11 15L16 10">
                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="2s" values="14;0" />
                            </path>
                        </g>
                        </svg>
                    </div>
                    <div class="font-mono text-3xl">Submitted!</div>
                </div>
                <!-- failed -->
                <div v-if="failedSubmit" class="bg-blue-500  mx-auto sm:full sm:h-fit rounded text-center">
                    <div class="w-full ">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="200px" height="200px" viewBox="0 0 24 24">
                        <rect width="24" height="24" fill="none" />
                        <g fill="none" stroke="#ff8000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path stroke-dasharray="60" stroke-dashoffset="60" d="M12 3L21 20H3L12 3Z">
                            <animate fill="freeze" attributeName="stroke-dashoffset" dur="1.5s" values="60;0" />
                            </path>
                            <path stroke-dasharray="6" stroke-dashoffset="6" d="M12 10V14">
                            <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.8s" dur="0.6s" values="6;0" />
                            </path>
                        </g>
                        <circle cx="12" cy="17" r="1" fill="#ff8000" fill-opacity="0">
                            <animate fill="freeze" attributeName="fill-opacity" begin="2.4s" dur="1.2s" values="0;1" />
                        </circle>
                        </svg>
                    </div>
                    <div class="font-mono text-3xl">Failed to submit!</div>
                </div>
            </form>
        </div>

    <!-- 
        SHOPPING LIST
     -->

    <div v-if="cart.products.length !== 0">
        <div class="font-bold text-center text-xl my-3">
                The shopping list
        </div>
        <Toast />
        <ConfirmPopup></ConfirmPopup>
        <DataTable :value="cart.products" size="small" tableStyle="min-width: 50rem">
            <Column field="id" header="ID."></Column>
            <Column field="product" header="Product"></Column>
            <Column field="quantity" header="Quantity"></Column>
            <Column field="company" header="Company"></Column>
            <Column field="shop" header="Shop"></Column>
            <Column field="info" header="Info"></Column>
            <Column  header="Action">
                <template #body="slotProps">
                    <Button label="Edit" class="mx-2" @click="edit(slotProps)"  severity="success" />
                    <Button @click="confirm2($event,slotProps)" label="Delete" severity="danger" outlined></Button>
                </template>
                
            </Column>
        </DataTable>
  
    </div>

    <!-- 
        FINITO LE  PROCESS
     -->
     <div  v-if="cart.products.length !== 0">
        <div class="flex justify-center my-2">
            <router-link :to="{name:'Checkout'}" class="bg-green-500 hover:bg-green-600 w-3/4 py-2 rounded-md text-center font-bold">CHECKOUT</router-link>
        </div>
     </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import store from '../../store'
import { PencilIcon,TrashIcon } from "@heroicons/vue/24/outline";
import InputText from 'primevue/inputtext'
import FloatLabel from 'primevue/floatlabel'
import Textarea from 'primevue/textarea';
import Select from 'primevue/select'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Button from 'primevue/button';
import { useToast } from "primevue/usetoast";
import ConfirmPopup from 'primevue/confirmpopup';
import { useConfirm } from "primevue/useconfirm";
const confirm = useConfirm();
const toast = useToast();

let editItem = (data) => {
    
    toast.add({ severity: 'success', summary: 'Success Message', detail: 'Item updated', life: 3000 });
};
store.dispatch('userData')

const product = ref({
    product :'',
    quantity:'',
    type:'',
    price:'',
    company:'',
    shop:'',
    info:''
})
const types = ref([
    { name: 'Kilograms', code: 'kg' },
    { name: 'Litres', code: 'l' },
    { name: 'pieces', code: 'pieces' },
])
const disabledAddBtn = ref(false)
const deleteBtn = ref(false)
const productId = ref()
const cart = ref()
store.dispatch('cartItems')
.then((res)=>{
    // console.log(res.items)
})
.catch(()=>{
    alert('error fetching cart items')
})

cart.value  =  store.state.products


const user = store.state.user
function addToCart(){
    if(productId.value != null){
        disabledAddBtn.value = true
        product.value.quantity = product.value.quantity + " " + product.value.type.code
       let  editedProduct = {
            'productId' : productId.value,
            'product' :  product.value
        }
        store.dispatch('editCart',editedProduct)
        .then((data)=>{
            editItem(productId.value)
            product.value.product = '' 
            product.value.quantity = '' 
            product.value.type = '' 
            product.value.company = '' 
            product.value.shop = '' 
            product.value.info = '' 
            disabledAddBtn.value = false
        })
    }else{
        disabledAddBtn.value = true
        product.value.quantity = product.value.quantity + " " + product.value.type.code
        store.dispatch('addToCart',product.value)
        .then((data)=>{
            product.value.product = '' 
            product.value.quantity = '' 
            product.value.type = '' 
            product.value.company = '' 
            product.value.shop = '' 
            product.value.info = ''
            disabledAddBtn.value = false 
        })
        .catch((err)=>{
            disabledAddBtn.value = false
        })
    }

}
function edit(item){
    // console.log(item.data.quantity)

    let quantity_arr = item.data.quantity.split(" ")
    console.log(quantity_arr);
    if(quantity_arr[1] == 'l'){
        quantity_arr[1] = { "name": "Litres", "code": "l" }
    }else if(quantity_arr[1]  == 'kg'){
        quantity_arr[1]  =  { "name": "Kilograms", "code": "kg" }
    }else if(quantity_arr[1] == 'pieces'){
        quantity_arr[1]  =  { "name": "pieces", "code": "pieces" }
    }
    productId.value = item.data.id   
    product.value.product = item.data.product
    product.value.quantity = quantity_arr[0]
    product.value.type = quantity_arr[1]
    product.value.company = item.data.company
    product.value.shop = item.data.shop
    product.value.info = item.data.info



}
function removeFromCart(item){
    store.dispatch('removeFromCart',item.id)
    .then((data)=>{
      deleteBtn.value = false  
    })
    .catch((err)=>{

    })
}

const confirm2 = (event,item) => {
    confirm.require({
        target: event.currentTarget,
        message: 'This remove the item from the cart?',
        icon: 'pi pi-info-circle',
        rejectProps: {
            label: 'Cancel',
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: 'Remove',
            severity: 'danger'
        },
        accept: () => {
            toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
            removeFromCart(item.data)
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    })
}
</script>

<style>

</style>