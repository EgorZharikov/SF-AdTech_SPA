<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">

<a class="navbar-brand" href="">
                    <img src="/img/logo.png" alt="logo" width="45">
                    SF-AdTech
                </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Offers</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <router-link class="btn btn btn-outline-light me-2" to="/login">Sign in</router-link>
        <router-link  class="btn btn btn-outline-light me-2" to="/registration">Sign up</router-link>
      </form>
      
    </div>
  </div>
</nav>
    <div class="container">
        <div class="row justify-content-center">

                <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
