<template>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">

      <router-link class="navbar-brand" to="/">
        <img src="/img/logo.png" alt="logo" width="45">
        SF-AdTech
      </router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Offers</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <router-link class="nav-link" to="/login">Sign in</router-link>
          </li>

          <li class="nav-item">
            <router-link class="nav-link" to="/registration">Sign up</router-link>
          </li>

          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              {{ this.user.name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="">
                Dashboard
              </a>
              <a @click.prevent="logout" class="dropdown-item" href="#">
                Logout
              </a>
            </div>
          </li>

        </ul>


      </div>
    </div>
  </nav>

      <router-view></router-view>

</template>

<script>
export default {
  name: "Index",
  data() {
    return {
        id: null,
        email: null,
        name: null,
        role_id: null,
        banned_at: null,
    }
    
  },
  methods: {
    logout() {
      axios.post('/logout')
        .then(res => {
          sessionStorage.clear()
          this.$router.push({name: 'login'})
        })
    },
    getUserData() {
      let user = JSON.parse(sessionStorage.getItem('user')) ?? false

        this.id = user.id
        this.name = user.name
        this.email = user.email
        this.role_id = user.role_id
        this.banned_at = user.banned_at

    }
  },
  mounted() {

    this.getUserData()
    console.log(this.name)
    this.$router.push({ name: 'home' })
  }
}
</script>
