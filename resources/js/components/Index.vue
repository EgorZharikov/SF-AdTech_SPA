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
  },
  computed: {
    user() {
      return this.$store.getters.user
    }
  },
    mounted() {
    this.$nextTick(function () {
      this.$store.dispatch('getUserData')
    })
  }
}
</script>
