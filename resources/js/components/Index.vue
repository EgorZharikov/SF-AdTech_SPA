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
  watch: {
    user: {
      handler(newUser) {
        if (newUser) {
          this.notificationsSubscribe()
        }
      },
      // force eager callback execution
      immediate: true
    }
  },
  methods: {
    triggerToast(icon, text) {
      this.$swal({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        icon: icon,
        title: 'Notification',
        text: text,
        showCancelButton: 'true'
      });
    },
    notificationsSubscribe() {
      console.log(this.$store.getters.balance)
      if (this.$store.getters.user) {
        this.notificationsUnsubscribe();
        window.Echo.private(`notification_${this.$store.getters.user.id}`)
          .listen('.notification', (e) => {
            this.triggerToast(e.status, e.message)
          })
      }
    },
    notificationsUnsubscribe() {
      window.Echo.leave(`notification_${this.$store.getters.user.id}`)
    }
  }
}
</script>
