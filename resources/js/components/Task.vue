<template>
    <li class="flex justify-between my-2 py-1 px-3  hover:bg-slate-500 ">
                <input type="checkbox" name="done" id="done">
                <span>Group meeting at 4pm</span>
                <button class="bg-red-100 text-xl px-1 text-black" >Delete</button>
            </li>
</template>
<script>
export default{
    data(){
        return {
            delete : true
        }
    }

}
</script>
