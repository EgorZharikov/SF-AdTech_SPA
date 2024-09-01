<template>
    <main>
        <div class="container">
            <div class="row account-card align-items-center" :style="{height: 100 + 'vh'}">
                <div class="col col-md-4 offset-md-4">
                    <div class="account-logo text-center">
                        <h3 class="h3 mb-3 fw-normal">Please sign in</h3>
                    </div>
                    <form name="signin-form" action="signin" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Login</label>
                            <input v-model="email" type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input v-model="password" type="password" autocomplete="off" name="password"
                                class="form-control" id="password">
                        </div>
                        <div class="d-grid gap-2">
                            <button @click.prevent="login" type="submit" name="signin"
                                class="btn btn-primary">Login</button>
                        </div>
                        <div class="mt-1 form-checks">
                            <input v-model="remember" type="checkbox" class="form-check-input me-2" name="remember"
                                id="remember">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                        </div>

                        <div class="account-logo mt-3 text-center"><router-link to="/registration">Create
                                account</router-link></div>
                        <div v-if="errors" class="alert alert-danger mt-3" role="alert">
                            <p v-for="error in errors">{{ error.toString() }}</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: null,
            password: null,
            errors: null,
            remember: null,
        }
    },
    methods: {
        login() {
            let remember = this.remember ? 1:0
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', { email: this.email, password: this.password, remember: this.remember })
                    .then(res => {
                        console.log(res)
                        if (res.data.data.hasOwnProperty("name")) {
                            this.$store.commit('setUser', res.data.data)
                            this.$store.commit('setBalance', res.data.data.wallet.balance)
                            this.$router.push({ name: 'index' })
                        }
                    }).catch(err => {
                        console.log(err)
                    this.errors = err.response.data.errors
                })
            })
        },
    },
    computed: {
        user() {
            return this.$store.getters.user
        }
    },
    created() {
        this.$store.commit('setUser', null)
    }
}
</script>
