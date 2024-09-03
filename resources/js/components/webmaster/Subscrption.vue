<template>
    <main>
        <div class="container text-center">
            <h1 class="m-5">Subscribtions</h1>
            <div v-if="subscriptions" class="row justify-content-center align-items-center">
                <!-- @foreach ($subscriptions as $subscription) -->
                <div v-for="subscription in subscriptions" class="col-3 m-2 justify-content-center align-items-center">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ subscription.offer.title }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-success">Redirection award: {{ subscription.offer.award }} ₽
                            </li>
                            <li class="list-group-item">Topic: {{ subscription.offer.topic.name }}</li>
                            <!-- @if($subscription->offer->status == 1) -->
                            <li v-if="subscription.offer.status === 1" class="list-group-item text-success">Status:
                                active
                            </li>
                            <!-- @else -->
                            <li v-else class="list-group-item text-warning">Status: suspend </li>
                            <!-- @endif -->
                            <li class="list-group-item text-primary">Referal link:<br> {{
                                `${this.host}/redirects/${subscription.referal_link}` }} </li>
                        </ul>
                        <div class="card-body d-flex justify-content-center">
                            <router-link :to="{ name: 'offer.show', params: { id: subscription.offer.id } }"
                                class="btn btn-primary me-3">Explore</router-link>
                        </div>
                    </div>
                </div>
                <!-- @endforeach -->
            </div>
            <!-- {{ $subscriptions -> links() }} -->
        </div>
    </main>
</template>
<script>
export default {
    name: "webmaster.subscriptions",
    data() {
        return {
            user_id: null,
            subscriptions: null,
            status: null,
            host: window.location.host
        }
    },
    methods: {
        getSubscriptions() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/webmaster/subscriptions')
                    .then(res => {
                        this.subscriptions = res.data.data

                    }).catch(err => {

                    })
            })
        },
        unsubscribe() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(`/api/offers/${this.$route.params.id}/unsubscribe`)
                    .then(res => {
                        this.subscription()
                    }).catch(err => {

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
        this.getSubscriptions()
    },
    mounted() {
        this.$store.dispatch('getUserData')
    }
}
</script>