<template>
  <div class="  h-screen pb-5">
    <div class="w-full text-4xl  text-center py-5 font-semibold">
        <h2 class="mx-auto">SHOPPING</h2>
        <p class="text-sm font-light">lets  get it done...</p>
    </div>
    <div class="h-fit overflow-auto mb-5 ">
        
        <form  @submit.prevent="addToCart"  class="border px-3 py-2  bg-slate-200 sm:w-3/4 mx-auto rounded shadow place-items-center text-center">
            <div class=" sm:flex justify-between align-middle place-items-center w-full  ">
                <label for="productName" class="font-bold">Product name:</label>
                <input type="text" required name="productName"  v-model="product.product" class="border rounded-sm sm:w-3/4 w-full focus:ring-2 my-1 focus:ring-indigo-600"  placeholder="maize flour">
            </div>
            <div class=" sm:flex justify-between align-middle place-items-center w-full  ">
                <label for="quantity" class="font-bold">Quantity:</label>
                <div class="flex justify-center">
                    <input type="text" required name="quantity" v-model="product.quantity" class="border rounded-sm w-1/2  focus:ring-2 my-1 focus:ring-indigo-600" placeholder="2">
                    <select name="type" id="type" v-model="product.type" required class="border rounded-sm w-1/2 bg-white text-sm focus:ring-2 my-1 focus:ring-indigo-600">
                        <option value="litre">litre</option>
                        <option value="kilograms">kilograms (kg)</option>
                        <option value="pieces">pieces/packets</option>
                    </select>
                </div>
            </div>
            <div class=" sm:flex justify-between align-middle place-items-center w-full  ">
                <label for="price" class="font-bold">Estimated Price: <br> <span class="text-xs">(per kg/litre/piece )</span></label>
                <input type="text" required name="price" v-model="product.price" class="border rounded-sm sm:w-3/4 w-full  focus:ring-2 my-1 focus:ring-indigo-600 "  placeholder="120">
            </div>
            <div class=" sm:flex justify-between align-middle place-items-center w-full  ">
                <label for="price" class="font-bold">Brand/Company:</label>
                <input type="text" required autocomplete="none" name="price" v-model="product.company" class="border rounded-sm sm:w-3/4 w-full focus:ring-2 my-1 focus:ring-indigo-600 "  placeholder="soko">
            </div>
            <div class=" sm:flex justify-between align-middle place-items-center w-full  ">
                <label for="placeToBuy" class="font-bold">Place to buy:</label>
                <input type="text" required name="placeToBuy" v-model="product.shop" class="border rounded-sm sm:w-3/4 w-full  focus:ring-2 my-1 focus:ring-indigo-600 " placeholder="sayen">
            </div>
            <div class="">
                <label for="extraInfo" class="font-bold  text-left">Add Extra infomartion here:</label>
                <textarea name="extraInfo"  v-model="product.extraInformation"  id="" class="w-full min-h-[50px] max-h-[100px] rounded-md  focus:border-xl  focus:ring-2 my-1 focus:ring-indigo-600 bg-white " placeholder="extra information goes here"></textarea>
            </div>
            <div>
                <button v-if="!disabledAddBtn"  type="submit" class="bg-blue-600 hover:bg-blue-700 w-1/2 py-2  font-bold rounded-md">
                    Add to cart
                </button>
                <VProgressCircular color="blue"  indeterminate="2" rotate="100" bg-color="white" v-else></VProgressCircular>
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
        <div class="w-screen overflow-x-auto">
            <table class="px-2 mx-auto text-center border-2 border-black">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <!-- <th class="sm:block hidden">Price</th>
                        <th class="sm:block hidden">Brand</th>
                        <th class="sm:block hidden">Shop</th> -->
                        <th>Total</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody class="border">
                   
                    <tr v-for="item,index in cart.products" key="index " class="border">
                        <td>{{ index+1 }}</td>
                        <td>{{ item.product }}</td>
                        <td>{{ item.quantity }}</td>
                        <!-- <td class="sm:block hidden">{{ item.price }}</td>
                        <td class="sm:block hidden">{{ item.company }}</td>
                        <td class="sm:block hidden">{{ item.shop }}</td> -->
                        <td>{{ item.total }}</td>
                        <td class="flex  justify-around">
                            <div>
                                <button @click="editProduct(item.id)" class="my-1 bg-green-500 hover:bg-green-600 rounded-md px-2 py-1 border text-sm font-bold">
                                    <PencilIcon  class="w-5"></PencilIcon>
                                </button>
                                <!-- <VProgressCircular color="green" indeterminate=""></VProgressCircular> -->
                            </div>
                            <div>
                                <button  @click="removeFromCart(item.id)" class="my-1 bg-red-500 hover:bg-red-600 rounded-md px-2 py-1 border text-sm font-bold">
                                    
                                    <TrashIcon v-if="!deleteBtn"  class="w-5"></TrashIcon>

                                    <div v-else>
                                        <p v-if="item.id === deletedItem">
                                            <VProgressCircular color="white" size="20" indeterminate="" width="3"></VProgressCircular>
                                        </p>
                                        <TrashIcon v-else  class="w-5"></TrashIcon>
                                    </div>
                                   
                                </button>
                                <!-- <VProgressCircular v-else color="red" indeterminate=""></VProgressCircular> -->
                            </div>
                           
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" class="font-bold text-end">Total:</td>
                        <td >{{total.total}}</td>
                    </tr>
                </tbody>
            </table>

        </div>
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
import {  VProgressCircular } from 'vuetify/lib/components/index.mjs';
store.dispatch('userData')

const product = ref({
    product :'',
    quantity:'',
    type:'',
    price:'',
    company:'',
    shop:'',
    extraInformation:''
})
const disabledAddBtn = ref(false)
const editBtn = ref(false)
const deleteBtn = ref(false)
const deletedItem = ref()
const productId = ref()
store.dispatch('cartItems')
const total = ref(store.state.products)
const cart = ref()
cart.value  =  store.state.products
console.log(cart.value)
setTimeout(() => {
    console.log(cart.value)
}, 5000);
const user = store.state.user
function addToCart(){
    if(productId.value != null){
        disabledAddBtn.value = true
       let  editedProduct = {
            'productId' : productId.value,
            'product' :  product.value
        }
        store.dispatch('editCart',editedProduct)
        .then((data)=>{
            product.value.product = '' 
            product.value.quantity = '' 
            product.value.price = '' 
            product.value.company = '' 
            product.value.shop = '' 
            product.value.extraInformation = '' 
            disabledAddBtn.value = false
        })
    }else{
        disabledAddBtn.value = true
        store.dispatch('addToCart',product.value)
        .then((data)=>{
            product.value.product = '' 
            product.value.quantity = '' 
            product.value.price = '' 
            product.value.company = '' 
            product.value.shop = '' 
            product.value.extraInformation = ''
            disabledAddBtn.value = false 
        })
        .catch((err)=>{
            disabledAddBtn.value = false
        })
    }

}
function editProduct(item){
    
    let val = {
        'id':item
    }
    store.dispatch('editProduct',val)
    .then((data)=>{
        productId.value  = data[0].id
        product.value.product = data[0].product
        product.value.quantity = data[0].quantity
        product.value.price = data[0].price
        product.value.company = data[0].company
        product.value.shop = data[0].shop
        product.value.extraInformation = data[0].extraInformation
    })
    .catch((err)=>{

    })
}
function removeFromCart(item){
    deletedItem.value = item
    if(item){
        deleteBtn.value = true
    }
    deleteBtn.value = true
    let val = {
        'id':item
    }
    store.dispatch('removeFromCart',val)
    .then((data)=>{
      deleteBtn.value = false  
    })
    .catch((err)=>{

    })
}
</script>

<style>

</style>