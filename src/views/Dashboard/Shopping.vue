<template>
  <div class="bg-slate-300 py-10">
    <div class="w-full text-4xl  text-center py-5 font-semibold">
        <h2 class="mx-auto">SHOPPING</h2>
        <p class="text-sm font-light">lets  get it done...</p>
    </div>
    <div>
        <form  @submit.prevent="addToCart"  class="border px-3 py-2  bg-cyan-400 w-3/4 mx-auto rounded shadow place-items-center text-center">
            <div class=" flex justify-between align-middle place-items-center w-full  ">
                <label for="productName" class="font-bold">Product name:</label>
                <input type="text" required name="productName"  v-model="product.product" class="border rounded-sm w-3/4  focus:ring-2 my-1 focus:ring-indigo-600"  placeholder="Maize flour">
            </div>
            <div class=" flex justify-between align-middle place-items-center w-full  ">
                <label for="quantity" class="font-bold">Quantity:</label>
                <input type="text" required name="quantity" v-model="product.quantity" class="border rounded-sm w-3/4  focus:ring-2 my-1 focus:ring-indigo-600" placeholder="2 kg or 2 kilograms">
            </div>
            <div class=" flex justify-between align-middle place-items-center w-full  ">
                <label for="price" class="font-bold">Estimated Price: <br> <span class="text-xs">(per kg/litre )</span></label>
                <input type="text" required name="price" v-model="product.price" class="border rounded-sm w-3/4  focus:ring-2 my-1 focus:ring-indigo-600 "  placeholder="120">
            </div>
            <div class=" flex justify-between align-middle place-items-center w-full  ">
                <label for="price" class="font-bold">Brand/Company:</label>
                <input type="text" required name="price" v-model="product.company" class="border rounded-sm w-3/4  focus:ring-2 my-1 focus:ring-indigo-600 "  placeholder="soko">
            </div>
            <div class=" flex justify-between align-middle place-items-center w-full  ">
                <label for="placeToBuy" class="font-bold">Place to buy:</label>
                <input type="text" required name="placeToBuy" v-model="product.shop" class="border rounded-sm w-3/4  focus:ring-2 my-1 focus:ring-indigo-600 " placeholder="magunus">
            </div>
            <div class="">
                <label for="extraInfo" class="font-bold  text-left">Add Extra infomartion here:</label>
                <textarea name="extraInfo"  v-model="product.extraInformation"  id="" class="w-full min-h-[50px] max-h-[100px] rounded-md  focus:border-xl  focus:ring-2 my-1 focus:ring-indigo-600 bg-white " placeholder="extra information goes here"></textarea>
            </div>
            <div>
                <button  type="submit" class="bg-blue-600 hover:bg-blue-700 w-1/2 py-2  font-bold rounded-md">Add to cart</button>
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
        <div>
            <table class="w-3/4 mx-auto text-center border-2 border-black">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Shop</th>
                        <th>Total</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody class="border">
                   
                    <tr v-for="item,index in cart.products" key="index " class="border">
                        <td>{{ index+1 }}</td>
                        <td>{{ item.product }}</td>
                        <td>{{ item.quantity }}</td>
                        <td>{{ item.price }}</td>
                        <td>{{ item.company }}</td>
                        <td>{{ item.shop }}</td>
                        <td>{{ item.total }}</td>
                        <td class="flex  justify-around">
                            <button @click="editProduct(item.id)" class="my-1 bg-green-500 hover:bg-green-600 rounded-md px-2 py-1 border text-sm font-bold">
                               EDIT
                            </button>
                            <button @click="removeFromCart(item.id)" class="my-1 bg-red-500 hover:bg-red-600 rounded-md px-2 py-1 border text-sm font-bold">
                               DELETE
                            </button>
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

const product = ref({
    product :'',
    quantity:'',
    price:'',
    company:'',
    shop:'',
    extraInformation:''
})
const productId = ref()
store.dispatch('cartItems')
const total = ref(store.state.products)
const cart = ref()
cart.value  =  store.state.products

function addToCart(){
    if(productId.value != null){
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
        })
    }else{
        store.dispatch('addToCart',product.value)
        .then((data)=>{
            product.value.product = '' 
            product.value.quantity = '' 
            product.value.price = '' 
            product.value.company = '' 
            product.value.shop = '' 
            product.value.extraInformation = '' 
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
    let val = {
        'id':item
    }
    store.dispatch('removeFromCart',val)
    .then((data)=>{

    })
    .catch((err)=>{

    })
}
</script>

<style>

</style>