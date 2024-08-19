<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
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
                        <router-link class="nav-link" :to="{name: 'index'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Offers</a>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'offer.create'}">Create offer</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">


                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-star-fill">Products</i>

                        </a>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!user" class="nav-link" :to="{name: 'login' }">Sign in</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link v-if="!user" class="nav-link" :to="{name: 'registration'}">Sign up</router-link>
                    </li>


                    <li v-if="user" class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <router-link class="dropdown-item" :to="{ name: 'dashboard' }">
                                Dashboard
                            </router-link>
                            <a @click.prevent="logout" class="dropdown-item" href="">
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Navbar",
    methods: {
        logout() {
            axios.post('/logout')
                .then(res => {
                    sessionStorage.clear()
                    this.$store.dispatch('getUserData')
                    this.$router.push({ name: 'index' })
                }).catch(err => {
                    sessionStorage.clear()
                    this.$store.dispatch('getUserData')
                    this.$router.push({ name: 'index' })
                })
        }

    },
    computed: {
        user() {
            return this.$store.getters.user
        }
    },
    mounted() {
        this.$store.dispatch('getUserData')
    }

}
</script>
<style scoped>
 .bd-placeholder-img {
     font-size: 1.125rem;
     text-anchor: middle;
     -webkit-user-select: none;
     -moz-user-select: none;
     user-select: none;
 }

 @media (min-width: 768px) {
     .bd-placeholder-img-lg {
         font-size: 3.5rem;
     }
 }

 .b-example-divider {
     width: 100%;
     height: 3rem;
     background-color: rgba(0, 0, 0, .1);
     border: solid rgba(0, 0, 0, .15);
     border-width: 1px 0;
     box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
 }

 .b-example-vr {
     flex-shrink: 0;
     width: 1.5rem;
     height: 100vh;
 }

 .bi {
     vertical-align: -.125em;
     fill: currentColor;
 }
</style>