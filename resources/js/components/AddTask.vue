<template>
    <div class="bg-slate-400 text-center flex justify-center align-baseline">
        <form action="">
            <span class="text-green-200">Task</span>
            <input type="text" class="border-0 border-b-2  font-serif text-blue-700 border-black  outline-none w-1/4 rounded mx-3">
            <button class="bg-blue-400 hover:bg-blue-500 border-2 border-blue-500 rounded  text-black px-0.5" @click="clicked()">Add</button>
        </form>
    </div>
</template>

<script>
export default{
    methods: {
        clicked(){
            
            axios.get('/items')
            .then(response =>{
                alert(response.status)
                if(response.status == 200){
                    alert('success')
                }
            })
            .catch(error =>{
              console.log(error);
            })
        }
    }
}
</script>