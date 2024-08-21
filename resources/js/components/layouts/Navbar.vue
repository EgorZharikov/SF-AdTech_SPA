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
                        <router-link class="nav-link" :to="{ name: 'offer.index' }">Offers</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'offer.create'}">Create offer</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#" class="text-white nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="cornflowerblue"
                                class="bi bi-speedometer" viewBox="0 0 16 16">
                                <path
                                    d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                                <path fill-rule="evenodd"
                                    d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!user" class="nav-link" :to="{name: 'login' }">Sign in</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!user" class="nav-link" :to="{name: 'registration'}">Sign up</router-link>
                    </li>
                    <li v-if="user" class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="cornflowerblue"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            {{ user.name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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