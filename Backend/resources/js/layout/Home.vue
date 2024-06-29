<template>
   <div class="bg-slate-200 h-screen m-auto w-1/2 p-3">
      <TopNav></TopNav>
      <Content></Content>
      <form method="POST" action="mpesa">

        <button type="submit">send a post  req</button>
      </form>
   </div>
   
 
</template>

<script>
import TopNav from '@/components/TopNav.vue'
import Content from '@/components/content.vue'

export default{
    components:{
        TopNav,
        Content
    }
}
</script>