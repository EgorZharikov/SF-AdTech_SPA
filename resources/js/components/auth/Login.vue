<template>
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
                        <input v-model="password" type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="d-grid gap-2">
                        <button @click.prevent="login" type="submit" name="signin"
                            class="btn btn-primary">Login</button>
                    </div>
                    <div class="mt-1 form-checks">
                        <input type="checkbox" class="form-check-input me-2" id="exampleCheck1" name="save_user">
                        <label class="form-check-label" for="exampleCheck1">Сохранить вход</label>
                    </div>

                    <div class="account-logo mt-3 text-center"><router-link to="/registration">Создать аккаунт</router-link></div>
                    <div v-if="error" class="alert alert-danger mt-3" role="alert">{{ this.error }}</div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            email: null,
            password: null,
            error: null,
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', { email: this.email, password: this.password })
                    .then(res => {
                        if (res.data.hasOwnProperty("name")) {
                            sessionStorage.setItem('user', JSON.stringify(res.data))
                            this.$store.dispatch('getUserData')
                            this.$router.push({ name: 'index' })
                        }
                    }).catch(err => {
                    this.error = 'Invalid password or login'
                })
            })
        }
    }
}
</script>
