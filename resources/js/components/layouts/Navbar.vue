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
                        <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="user" class="nav-link" :to="{ name: 'offer.index' }">Offers</router-link>
                    </li>
                    <li v-if="user" class="nav-item">
                        <router-link v-if="Number(user.role_id) === 1" class="nav-link"
                            :to="{name: 'offer.create'}">Create offer</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li v-if="user" class="nav-item">
                        <router-link v-if="Number(user.role_id) === 1" :to="{ name: 'advertiser.offers' }"
                            class="text-white nav-link" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="cornflowerblue"
                                class="bi bi-card-checklist" viewBox="0 0 16 16">
                                <path
                                    d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                <path
                                    d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                            </svg>
                            Offers
                        </router-link>
                    </li>
                    <li v-if="user" class="nav-item">
                        <a @click.prevent="statistics" href="" class="text-white nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="cornflowerblue"
                                class="bi bi-table" viewBox="0 0 16 16">
                                <path
                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z" />
                            </svg>
                            Statistics
                        </a>
                    </li>
                    <li v-if="user" class="nav-item">
                        <router-link v-if="Number(user.role_id) === 2" :to="{ name: 'webmaster.subscriptions' }"
                            class="text-white nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="cornflowerblue"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            Subscriptions
                        </router-link>
                    </li>
                    <li v-if="user" class="nav-item">
                        <a @click.prevent="wallet" class="text-white nav-link" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="cornflowerblue"
                                class="bi bi-wallet2" viewBox="0 0 16 16">
                                <path
                                    d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                            </svg>
                            Wallet
                        </a>
                    </li>
                    <li v-if="user" class="nav-item">
                        <router-link v-if="Number(user.role_id) === 3"
                            class="text-white nav-link" :to="{ name: 'administrator.users' }" >
                            <svg xmlns=" http://www.w3.org/2000/svg" width="20" height="20" fill="cornflowerblue"
                            class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                            </svg>
                            Users
                        </router-link>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="cornflowerblue"
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
                            <a @click.prevent="profile" class="dropdown-item" href="">
                                Profile
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>
<style scoped>
nav a:hover,
nav a.router-link-exact-active {
    color: green;
}
nav a.router-link-active {
    color: green;
}
</style>
<script>
export default {
    name: "Navbar",
    methods: {
        logout() {
            axios.post('/logout')
                .then(res => {
                    this.$root.notificationsUnsubscribe()
                    this.$store.commit('setUser', null)
                    this.$router.push({ name: 'index' })
                }).catch(err => {
                    this.$store.commit('setUser', null)
                    this.$store.commit('setBalance', null)
                    this.$router.push({ name: 'index' })
                })
        },
        wallet() {
            switch (Number(this.user.role_id)) {
                case 1:
                    this.$router.push({ name: 'advertiser.wallet' })
                    break;
                case 2:
                    this.$router.push({ name: 'webmaster.wallet' })
                    break;
                case 3:
                    this.$router.push({ name: 'administrator.wallet' })
                    break;
            }
            
        },
        statistics() {
            switch (Number(this.user.role_id)) {
                case 1:
                    this.$router.push({ name: 'advertiser.statistics' })
                    break;
                case 2:
                    this.$router.push({ name: 'webmaster.statistics' })
                    break;
                case 3:
                    this.$router.push({ name: 'administrator.statistics' })
                    break;
            }
        }, profile() {
            switch (Number(this.user.role_id)) {
                case 1:
                    this.$router.push({ name: 'advertiser.profile' })
                    break;
                case 2:
                    this.$router.push({ name: 'webmaster.profile' })
                    break;
                case 3:
                    this.$router.push({ name: 'administrator.profile' })
                    break;
            }
        },


    },
    computed: {
        user() {
            return this.$store.getters.user
        },
    }
}
</script>