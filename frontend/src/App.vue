<template>
  <header>
      <div class="flex flex-row h-20 bg-white border-b-2 shadow-md">
        <a href="/" class="basis-1/4 h-20 bg-[url('./assets/logo_plan.png')] bg-no-repeat bg-center"></a>
          <!---<nav class="basis-2/2 h-20">
            <ul class=" text-black mx-auto block">
                <li><router-link to="/">Home</router-link> |</li>
            </ul>
        </nav>-->
      </div>      
  </header>

  <section>
        <router-view/>
  </section>


  <footer class="h-12 bg-orange-500 relative bottom-0 w-full">
    <div class="flex flex-row h-12 w-full text-center">
      <ul class="flex-auto text-white text-sm">
        <li class="align-middle block h-12 pt-4">Copyright 2022 ©</li>
      </ul>
    </div>
  </footer>

 
</template>

<script>
export default {
  setup() {
    
  },
}
</script>
