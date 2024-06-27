import {createStore} from "vuex"
import axiosClient from "../axios/axios";
const store = createStore({
    state:{
        paths:{
            destinations:[]
        },
        user:{
            data:{},
            token: sessionStorage.getItem('Auth'),
            login:'',
            rides:'',
            shopping:'',
            packages:'',
        },
        dashboard:{
            loading:false,
            data:{}
        },
        products:{
            products:[],
            total:'',
            confirmed:'',
            number:'',
            mpesaCode:'',
            destination:'',
            numberToCall:'',
        },
        transport:{
            currentLocation:'',
            destination:'',
            pickUpTime:'',
            confirmed:''
        },
        package:{
            location:'',
            destination:'',
            time:'',
            weight:'',
            confirmed:'',
            price:''
        },
        rider:{
            data:[],
            response:''
        },
        payments:{
            number:'',
            mpesaCode:''
        },
        name:''

        
    },
    getters:{},
    actions:{
        async register({commit},user){
            const {data} = await axiosClient.post('/register',user)
            commit('registerUser',data)
            return data
        },
        async login({commit},user){
            const {data} = await axiosClient.post('/login',user)
            commit('loginUser',data)
            return data
        },
        async logout({commit},user){
            console.log%("logging out")
            const {data} = await axiosClient.post('/logout',user)
            commit('logoutUser',data)
            return data
        },
        async userData({commit}){
            const data = await axiosClient.get('/home')
            commit('userData',data)
        },
        /**
         * S H O P P I N G
         */
        async addToCart({commit},product){
            const res = await axiosClient.post('/addToCart',product);
            console.log(res)
            commit('cartItems',res)
            return res
        },
        async cartItems({commit}){
            const products = await axiosClient.get('/cartItems')
            // commit('cartItems',products)
            // let body =  JSON.stringify({
            //     "BusinessShortCode": 174379,
            //     "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjQwNTEzMjA1MTMw",
            //     "Timestamp": "20240513205130",
            //     "TransactionType": "CustomerPayBillOnline",
            //     "Amount": 1,
            //     "PartyA": 254708475592,
            //     "PartyB": 174379,
            //     "PhoneNumber": 254708475592,
            //     "CallBackURL": "https://mydomain.com/path",
            //     "AccountReference": "BodaBodaRide",
            //     "TransactionDesc": "Payment of X" 
            //   })
            // const x = await axiosClient.post('/sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',body)
            // console.log(x);
            // let headers = new Headers();
            // headers.append("Content-Type", "application/json");
            // headers.append("Authorization", `Bearer ${store.state.user.token}`);
            
            // fetch("https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest", {
            //   method: 'POST',
            //   headers,
            //   body: JSON.stringify({
            //     "BusinessShortCode": 174379,
            //     "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjQwNTEzMjA1MTMw",
            //     "Timestamp": "20240513205130",
            //     "TransactionType": "CustomerPayBillOnline",
            //     "Amount": 1,
            //     "PartyA": 254708475592,
            //     "PartyB": 174379,
            //     "PhoneNumber": 254708475592,
            //     "CallBackURL": "https://mydomain.com/path",
            //     "AccountReference": "BodaBodaRide",
            //     "TransactionDesc": "Payment of X" 
            //   })
            // })
            //   .then(response => response.text())
            //   .then(result => console.log(result))
            //   .catch(error => console.log(error));

            commit('cartItems',products)
            console.log(products)
            return products.data

        },
        async editProduct({commit},item){
            const data = await axiosClient.post('/editProduct',item)
            return data.data.product
        },
        async editCart({commit},item){
            const res = await axiosClient.post('/editCart',item)
            commit('cartItems',res)
        },
        async removeFromCart({commit},item){
            const res = await axiosClient.post('/removeFromCart',item)
            commit('cartItems',res)
        },
        // async cartTotal({commit}){
        //     const res = await axiosClient.get('/cartTotal')
        //     commit('cartTotal',res)
        // },
        async riderRequest({commit}){
            const data = await axiosClient.post('/riderRequest')
            commit('riderResponse',data)
        },
        async continueProcess({commit},data){
            let process = {
                'data' : data
            }
            const  res = await axiosClient.post('/continueProcess',process)
            console.log(res.data.productData)
            commit('continueProcess',res)
            return res.data.choice
        },
        async setDestination({commit},data){
            let destination = {
                'data' : data
            }
            const  res = await axiosClient.post('/setDestination',destination)
            const products = await axiosClient.get('/cartItems')
            commit('cartItems',products)
            commit('setDestination',res)
        },
        async setNumber({commit},data){
            let phoneNumber = {
                'data' : data
            }
            const  res = await axiosClient.post('/setNumber',phoneNumber)
            console.log(res)
            const products = await axiosClient.get('/cartItems')
            commit('cartItems',products)
            commit('setNumber',res)
        },
        async confirmationCode({commit},data){
            let mpesaCode = {
                'data' : data
            }
            const res = await   axiosClient.post('/confirmationCode',mpesaCode)
            commit('mpesaCode',res)
        },
        /**
         * R I D E
         */
        async rideRequest({commit},data){
            // let ride = {
            //     'data' : data
            // }
            const res = await axiosClient.post('/rideRequest',data)
            commit('rideReq',res)
        },
        async rideConfirmation({commit},data){
            let confirmation = {
                'data' : data
            }
            const res = await axiosClient.post('/rideConfirmation',confirmation)
            commit('rideConfirmation',res)
        },
        async ride({commit},data){
            if(data == 1){
                let ride  = {
                    'continue': true,
                    'rider' : store.state.rider.data.username,
                    'price' : store.state.rider.data.price,
                    'paid' : true
                }
                
                const res = await axiosClient.post('/ride',ride)
            }else if(data == 0){
                let ride  = {
                    'continue': false,
                }
                const res = await axiosClient.post('/ride',ride)
            }
            commit('ride')
        },
        /**
         * P A C K A G E
         */
        async packageRider({commit},data){
            const res = await axiosClient.post('/packageRider',data)
            commit('packageRider',res)
        },
        async packageConfirmation({commit},data){
            let  confirmation = {
                data:data,
                rider: store.state.rider
            }
            const respone = data == 1 ? await axiosClient.post('packageConfirmation',confirmation) : axiosClient.post('packageConfirmation',confirmation)
            commit('packageConfirmation',respone)
        },
        async setPackageNumber({commit},data){
            let phoneNumber = {
                'data' : data
            }
            const  res = await axiosClient.post('/setPackageNumber',phoneNumber)
            
            commit('setPackageNumber',res)
        },
        async confirmationPackageCode({commit},data){
            let mpesaCode = {
                'data' : data
            }
            const res = await   axiosClient.post('/confirmationPackageCode',mpesaCode)
            commit('confirmationPackageCode',res)
        },
    
     },
    mutations:{
        registerUser:(state,data)=>{
            sessionStorage.setItem('Auth',data.token)
            state.user.token = sessionStorage.getItem('Auth')
        },
        loginUser:(state,data)=>{
            sessionStorage.setItem('Auth',data.token)
            
            state.user.token = sessionStorage.getItem('Auth')
        },
        logoutUser:(state,data)=>{
            console.log("data token " + data.token)
            sessionStorage.removeItem("Auth")
            state.user.token = sessionStorage.getItem('Auth')
        },
        userData:(state,data)=>{
            state.user.rides = data.data.rides
            state.user.shopping = data.data.shopping
            state.user.packages = data.data.packages
            state.user.data = data.data.user
        },
        cartItems:(state,products)=>{
            state.products.products = products.data.items
            console.log(products.data.items)
            let total = 0
            for (let index = 0; index < products.data.items.length; index++) {
                total += Number(products.data.items[index].total)       
            }
            state.products.total = total
        },
        // cartTotal:(state,res)=>{
        //     state.products.total = total
        // },
        riderResponse:(state,data)=>{
            console.log(data.data)
            state.rider.data = data.data
            state.rider.response = data.data.response
        },
        continueProcess:(state,res)=>{
            if(res.data.choice == 'confirmed'){
                state.products.confirmed = true
            }else{
                state.products.confirmed = false
            }
        },
        setDestination:(state,res)=>{
            state.products.destination = res.data.destination
        },
        setNumber:(state,res)=>{
            state.products.numberToCall = res.data.number
        },
        confirmationCode:(state,res)=>{
            state.products.mpesaCode = res.data.code
        },
        rideReq:(state,res)=>{
            state.transport.currentLocation = res.data.details.location
            state.transport.destination = res.data.details.destination
            state.transport.pickUpTime = res.data.details.time
            state.rider.data = res.data.rider
            state.rider.response = res.data.rider.response
        },
        rideConfirmation:(state,res)=>{
            state.transport.confirmed = res.data.ride.confirmed  == 1 ? true : false
        },
        ride:(state)=>{
            state.transport.currentLocation = ''
            state.transport.destination = ''
            state.transport.pickUpTime = ''
            state.transport.confirmed = ''
            state.rider.data = [];
            state.rider.response = '';
        },
        packageRider:(state,response)=>{
            state.package.location = response.data.package.location
            state.package.destination = response.data.package.destination
            state.package.weight = response.data.package.weight
            state.package.time = response.data.package.time
            state.rider.data = response.data.rider
        },
        packageConfirmation:(state,response)=>{
            state.package.confirmed = response.data.package.confirmed
            state.package.price = response.data.package.price
        },
        setPackageNumber:(state,res)=>{
            console.log(res)
            state.payments.number = res.data.data.number
        },
        confirmationPackageCode:(state,res)=>{
            state.payments.mpesaCode = res.data.data.transactionCode
        }
    },
    modules:{}
})

export default store;