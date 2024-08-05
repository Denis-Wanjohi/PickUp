<template>
        <div class="sm:w-1/2 w-full  px-5 border border-white m-auto">
            <form  class="border-b  border-gray-900/10 pb-12" @submit.prevent="riderDetails">
                <h2 class=" text-2xl pt-5 font-semibold leading-7 text-gray-900 text-center">Rider Registration</h2>
                <!-- <p class="mt-1 text-sm leading-6 text-gray-400 text-center">Incase of any inquiry please reach out to us through this form.Thank you  :)</p> -->
                <p class="mt-1 text-sm leading-6 text-gray-400 text-center">Please fill in correct details*</p>


                <div v-if="!isFormFilled" class="mt-10  grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 place-items-center">

                    <!-- FIRST NAME -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="firstname" required v-model="rider.firstname" />
                        <label for="firstname">Firstname</label>
                    </FloatLabel>
                    </div>

                    <!-- LAST NAME -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="lastname" required v-model="rider.lastname" />
                        <label for="lastname">Lastname</label>
                    </FloatLabel>
                    </div>

                    <!-- USER NAME -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="username" required v-model="rider.username" />
                        <label for="username">Username</label>
                    </FloatLabel>
                    </div>
                    
                    <!-- EMAIL -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="email" required v-model="rider.email" />
                        <label for="email">Email</label>
                    </FloatLabel>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="phone" required v-model="rider.phone" />
                        <label for="phone">Phone Number</label>
                    </FloatLabel>
                    </div>

                    <!-- AGE -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="age" required v-model="rider.age" />
                        <label for="age">Age</label>
                    </FloatLabel>
                    </div>

                    <!-- BIKE -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="bike" required v-model="rider.bike" />
                        <label for="bike">Bike Brand</label>
                    </FloatLabel>
                    </div>

                    <!-- STATION -->
                    <div class="sm:col-span-3">
                    <FloatLabel>
                        <InputText id="station" required v-model="rider.station" />
                        <label for="station">Station</label>
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
</template>

<script setup>
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'
import FloatLabel from 'primevue/floatlabel'
import   store from  '../../store/index'
import router  from '../../router/index'
import{ref} from 'vue'
const rider = {
    firstname:'',
    lastname:'',
    email:'',
    phone:'',
    username:'',
    age:'',
    bike:'',
    station:'',
}
const submitting = ref()
const emailSent = ref()
const failedSubmit = ref()
function riderDetails(){
    store.dispatch('registerRider',rider)
        .then((res)=>{
            if(res.data = 'success'){
                router.push('/home')
            }
        })
        .catch((err)=>{
            console.log("err :"+ err)
        })
}
</script>
