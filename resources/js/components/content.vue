<template>
    <div class="text-center pt-2 text-white bg-slate-700">
        <span class="text-xl">
            Hello <br>
            Add Task...
        </span>
        <AddTask></AddTask>
        <Tasks></Tasks>
    </div>
</template>
<script>
import AddTask from '@/components/AddTask.vue'
import Tasks from '@/components/Tasks.vue'
export default{
    components:{
        AddTask,
        Tasks
    }

}
</script>