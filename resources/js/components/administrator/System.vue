<template>
    <main>
        <div class="container text-center">
            <div class="row align-items-center justify-content-center">
                <h1 class="m-5">System</h1>
                <div class="col col-md-3 offset-md-3 m-3">
                    <div class="card d-flex justify-content-center bg-dark" style="width: 20rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-success">
                                <h4>System fee: {{ fee }} %</h4>
                            </li>
                        </ul>
                        <form>
                            <div class="card-body d-flex justify-content-center" style="width: 20rem;">
                                <input v-model="amount" type="number" class="form-control px-5" aria-label="Amount"
                                    name="amount" step="0.1" min="0" pattern="\d*">
                            </div>
                            <div class="card-body d-flex justify-content-center p-1">
                                <button @click.prevent="setSystemFee" name="apply"
                                    class="btn btn-outline-success">
                                    Aply</button>
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
            fee: null,
            amount: null,
            errors: null,
        }
    },
    methods: {
        getSystemFee() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/administrator/system`)
                    .then(res => {
                        this.fee = res.data.percent


                    }).catch(err => {
                        this.errors = err.response.data.errors
                    })
            })
        },
        setSystemFee() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(`/api/administrator/system`, { amount: this.amount })
                    .then(res => {
                        this.fee = res.data.percent
                        this.$root.triggerToast('success', 'System fee updated success!')
                    }).catch(err => {
                        this.errors = err.response.data.errors
                    })
            })
        }
    },
    created() {
        this.getSystemFee()
    }
}
</script>