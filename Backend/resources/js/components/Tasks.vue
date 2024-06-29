<template>
    <div class="max-h-1/2 bg-purple-800">
        <ul class="">
            <li class="flex justify-between px-3 my-2 py-1 hover:bg-slate-500 ">
                <input type="checkbox" name="done" id="done">
                <span>Go to class</span>
                <button class="bg-red-100 text-xl px-1 text-black">Delete</button>
            </li>
            <li class="flex justify-between px-3 my-2 py-1 hover:bg-slate-500 ">
                <input type="checkbox" name="done" id="done">
                <span>Go do shopping</span>
                <button class="bg-red-100 text-xl px-1 text-black">Delete</button>
            </li>
            <li class="flex justify-between px-3 my-2  py-1   hover:bg-slate-500 ">
                <input type="checkbox" name="done" id="done">
                <span>Coffee Date</span>
                <button class="bg-red-100 text-xl px-1 text-black">Delete</button>
            </li>
            <Task></Task>
        </ul>
        
    </div>
</template>

<script>
import Task  from '@/components/Task.vue'
export default{
    components:{
        Task
    }

}
</script>