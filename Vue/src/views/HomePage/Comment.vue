<template>
  <div class="3/4 bg-cyan-200 pb-[40px]">
    <h3 class="text-center italic">For any comments or inquires please let us know</h3>
    <form @subit.prevent="comments" class="sm:w-1/2 mx-auto sm:px-0 px-4 text-center space-y-1">
        <input type="email" placeholder="example@gmail.com" required v-model="user.email" class="w-full rounded-t-xl border border-md border-black ">
        <textarea name="comment" id="comment" placeholder="leave a comment..." required  v-model="user.comment" class="border w-full max-h-[100px] min-h-[50px] rounded-b-lg bg-white"></textarea>
        <button class="bg-cyan-500 px-2 py-2 rounded-lg w-1/2 font-bold"   type="submit">Submit</button>
    </form>
  </div>
</template>

<script setup>
let  user = {
    email:'',
    comment:''
}
</script>

<style>

</style>