<template>
    <div class="container">
        <div class="row account-card align-items-center" :style="{height: 100 + 'vh'}">
            <div class="col col-md-4 offset-md-4">
                <div class="account-logo text-center">
                    <h3 class="h3 mb-3 fw-normal">Please sign up</h3>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input v-model="email" type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input v-model="name" type="text" name="name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select v-model="role_id" id="role_id" class="form-select" name="role_id">
                        <option value="1">advertiser</option>
                        <option value="2">webmaster</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input v-model="password" type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm password</label>s
                    <input v-model="password_confirmation" type="password" name="password_confirmation"
                        class="form-control" id="password_confirmation">
                </div>
                <div class="d-grid gap-2">
                    <button @click.prevent="register" type="submit" name="signup" id="signIn"
                        class="btn btn-primary">Register</button>
                </div>
                <div v-if="errors" class="alert alert-danger mt-3" role="alert">
                    <p v-for="error in errors">{{ error.toString()}}</p>
                </div>
            </div>
        </div>
        </div>
</template>

<script>
export default {
    name: "Registration",
    methods: {
        register() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    email: this.email, name: this.name,
                    role_id: this.role_id, password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(res => {
                        if (res.data.has("name")) {
                            sessionStorage.setItem('user', JSON.stringify(res.data))
                            this.$router.push({ name: 'index' })
                        }
                        

                    }).catch(err => {
                        this.errors = err.response.data.errors
                })
            })
        }
    },
    data() {
        return {
            email: null,
            name: null,
            password: null,
            role_id: null,
            password_confirmation: null,
            errors: null
        }
    },
}
</script>
