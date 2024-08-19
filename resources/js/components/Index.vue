<template>
  <Navbar/>

  <router-view :key="$route.fullPath"></router-view>


</template>

<script>
import Navbar from './layouts/Navbar.vue'
export default {
  name: "Index",
  components: {
    Navbar
  }
}
</script>
