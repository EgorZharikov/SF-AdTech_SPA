<template>
    <div class="container text-center">
        <h1 class="m-5">User management</h1>
        <div class="container">
            <div class="col-md-4 offset-md-4 p-3 border">
                <h4 class="mb-3 text-primary">Add user in system:</h4>
                <div class="row align-items-center">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input v-model="name" type="text" class="form-control" name="name" id="name"
                                aria-describedby="emailHelp">
                            <div v-if="errors" class="form-text text-danger">
                                <p v-for="error in errors.name"> {{ error }}</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input v-model="email" type="email" class="form-control" name="email" id="email"
                                aria-describedby="emailHelp">
                            <div v-if="errors" class="form-text text-danger">
                                <p v-for="error in errors.email"> {{ error }}</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input v-model="password" type="password" name="password" class="form-control"
                                id="password">
                            <div v-if="errors" class="form-text text-danger">
                                <p v-for="error in errors.password"> {{ error }}</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Select role</label>
                            <select v-model="role_id" id="role" name="role_id" class="form-select">
                                <option value="1">advertiser</option>
                                <option value="2">webmaster</option>
                                <option value="3">administrator</option>
                            </select>
                            <div v-if="errors" class="form-text text-danger">
                                <p v-for="error in errors.role_id"> {{ error }}</p>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button @click.prevent="addUser" type="submit" name="add_user"
                                class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h4 class="m-3 text-primary">User list:</h4>
        <div v-if="users" class="row align-items-center">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ban/Unban</th>
                    </tr>
                </thead>
                <!-- @foreach ($users as $user ) -->
                <tbody v-for="user in users">
                    <tr>
                        <td>{{ user.id }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.role.name }}</td>
                        <td v-if="user.banned_at" class="text-danger">banned</td>
                        <td v-if="!user.banned_at" class="text-success">active</td>
                        <td>
                            <form>
                                <button v-if="user.banned_at" @click.prevent="unbanUser(user)" type="submit"
                                    name="unban" class="btn btn-outline-success btn-sm">Unban</button>
                                <button v-if="!user.banned_at" @click.prevent="banUser(user)" type="submit" name="ban"
                                    class="btn btn-outline-danger btn-sm">Ban</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <!-- @endforeach -->
            </table>
        </div>
        <!-- {{ $users -> links() }} -->
    </div>

</template>
<script>
export default {
    data() {
        return {
            users: null,
            name: null,
            email: null,
            role_id: null,
            password: null,
            errors: null,
        }
    },
    methods: {
        getUsers() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/users')
                    .then(res => {
                        console.log(res)
                        this.users = res.data.data

                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        banUser(user) {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.patch(`/api/users/${user.id}/ban`)
                    .then(res => {
                        console.log(res)
                        this.getUsers()
                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        unbanUser(user) {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.patch(`/api/users/${user.id}/unban`)
                    .then(res => {
                        console.log(res)
                        this.getUsers()

                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        addUser() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/users', { name: this.name, email: this.email, role_id: this.role_id, password: this.password })
                    .then(res => {
                        console.log(res)
                        this.name = null
                        this.email = null
                        this.role_id = null
                        this.password = null
                        this.errors = null
                        this.getUsers()


                    }).catch(err => {
                        this.errors = err.response.data.errors
                    })
            })
        }
    },
    created() {
        this.getUsers()
    }
}
</script>