<template>
    <main>
        <div class="container text-center">
            <div class="row d-flex align-items-center justify-content-center" style="height:100vh;">

                <div class="col col-4 d-flex offset-md-4 m-3">
                    <div class="card d-flex justify-content-center bg-dark" style="width: 20rem;">
                        <h4 class="text-primary p-1">System wallet (total in system):</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-success">
                                <h4>{{ total }} ₽</h4>
                            </li>
                        </ul>
                        <h4 class="text-primary p-1">System income:</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-success">
                                <h4>{{ income }} ₽</h4>
                            </li>
                        </ul>
                    </div>
                </div>
                <div v-if="errors" class="row justify-content-center">
                    <div class="col col-4 offset-md-4 m-3 text-center">
                        <div class="alert alert-warning text-center" role="alert">
                            <p v-for="error in errors">{{ error.toString() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            total: null,
            income: null,
            errors: null,
        }
    },
    methods: {
        getSystemWallet() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/administrator/wallet`)
                    .then(res => {
                        this.total = res.data.total.balance
                        this.income = res.data.income.balance


                    }).catch(err => {
                        this.errors = err.response.data.errors
                    })
            })
        },
    },
    created() {
        this.getSystemWallet()
    }
}
</script>