<template>
    <main>
        <div class="container text-center">
            <div class="row align-items-center justify-content-center">
                <h1 class="m-5">Wallet</h1>
                <div class="col col-md-3 offset-md-3 m-3">
                    <div class="card d-flex justify-content-center bg-dark" style="width: 20rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-success">
                                <h4>Balance: {{ this.balance }} ₽</h4>
                            </li>
                        </ul>
                        <form>
                            <div class="card-body d-flex justify-content-center" style="width: 20rem;">
                                <input v-model="amount" type="number" class="form-control px-5" aria-label="Amount"
                                    name="amount" step="1" pattern="\d*">
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <button @click.prevent="replanish" name="replenish"
                                    class="btn btn-outline-success px-4 me-4">Replenish</button>
                                <button @click.prevent="withdraw" name="withdraw"
                                    class="btn btn-outline-success px-4 me-4">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- @if($errors->has('walletError')) -->
                <div v-if="errors" class="row justify-content-center">
                    <div class="col col-md-3 offset-md-3 m-3 text-center">
                        <div class="alert alert-warning text-center" role="alert">
                            <p v-for="error in errors">{{ error.toString() }}</p>
                        </div>
                    </div>
                </div>
                <!-- @endif -->
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            balance: null,
            amount: null,
            errors: null,
        }
    },
    methods: {
        getWallet() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/wallet`)
                    .then(res => {
                        this.balance = res.data.data.balance

                    }).catch(err => {
                       this.errors = err.response.data.errors
                    })
            })
        },
        replanish() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.patch(`/api/wallet`, { amount: this.amount, replenish: true })
                        .then(res => {
                            this.getWallet()

                        }).catch(err => {
                            this.errors = err.response.data.errors
                        })
                })
        },
        withdraw() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.patch(`/api/wallet`, { amount: this.amount, withdraw: true })
                    .then(res => {
                        this.getWallet()

                    }).catch(err => {
                        this.errors = err.response.data.errors
                    })
            })
        }
    },
    created() {
        this.getWallet()
    }
}
</script>