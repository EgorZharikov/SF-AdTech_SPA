<template>
  <Navbar/>

  <router-view v-slot="{ Component }">
    <transition name="fade" mode="out-in">
      <Component :is="Component"/>
    </transition>
  </router-view>


</template>
<style>
main {
  will-change: transform, opacity;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease-out;
}
</style>
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
    created() {
      this.$store.dispatch('getUserData')
  }
}
</script>
