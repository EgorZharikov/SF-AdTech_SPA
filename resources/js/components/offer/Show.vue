<template>
    <main>
        <div class="container my-5">
            <div v-if="offer" class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <router-link :to="{ name: 'offer.index' }"><img src="/img/go_back_arrow.png" alt="go_back"
                        style="width: 25px; height: 25px;"></router-link>
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <h1 class="display-7 fw-bold lh-1">{{ offer.title }}</h1>
                    <p class="lead">{{ offer.content }}</p>
                    <div class="col-md-5 col-lg-5 p-1 mb-4">
                        <div class="alert alert-success p-2" role="alert">
                            <div class="list-group-item d-flex justify-content-between">
                                <strong>Redirection award:</strong>
                                <strong>{{ offer.award }} ₽</strong>
                            </div>
                        </div>
                        <div class="alert alert-secondary p-2" role="alert">
                            <div class="list-group-item d-flex justify-content-between">
                                <strong>Topic:</strong>
                                <strong>{{ offer.topic.name }}</strong>
                            </div>
                        </div>

                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <button v-if="isWebmaster && !subscribed" @click.prevent="subscribe"
                            class="btn btn-success btn-lg px-4 me-md-2 fw-bold">Subscribe</button>

                        <button v-if="isWebmaster && subscribed" @click.prevent="unsubscribe"
                            class="btn btn btn-dark btn-lg px-4">Unsubscribe</button>

                        <router-link v-if="isAuthor" :to="{ name: 'offer.edit', params: { id: offer.id } }"
                            class="btn btn-primary btn-lg px-4 me-3">Edit</router-link>
                        <button v-if="isAuthor && Number(offer.status) === 1" @click.prevent="unpublish" type="submit"
                            class="btn btn btn-dark btn-lg px-4 me-3">Unpublish</button>
                        <button v-if="isAuthor && Number(offer.status) !== 1" @click.prevent="publish" type="submit"
                            class="btn btn btn-success btn-lg px-4">Publish</button>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 p-0 overflow-hidden shadow-lg">
                    <img class="rounded-lg-3" :src="offer.preview_image" alt="" width="324">
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            offer: null,
            subscribed: null
        }
    },
    created() {
        this.$watch(
            () => this.$route.params.id,
            (newId, oldId) => {
                console.log(newId)
            }
        )
        this.getOffer()
        this.subscription()
    },
    methods: {
        getOffer() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/offers/${this.$route.params.id}`)
                    .then(res => {
                        console.log(res.data.data)
                        this.offer = res.data.data

                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        subscribe() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(`/api/offers/${this.$route.params.id}/subscribe`)
                    .then(res => {
                        console.log(res)
                        this.subscription()
                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        unsubscribe() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(`/api/offers/${this.$route.params.id}/unsubscribe`)
                    .then(res => {
                        console.log(res)
                        this.subscription()
                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        subscription() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/offers/${this.$route.params.id}/subscription`)
                    .then(res => {
                        this.subscribed = Number(res.data.subscribed)
                        console.log(this.subscribed)

                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        publish() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/offers/${this.$route.params.id}/publish`)
                    .then(res => {
                        this.offer = res.data.data

                    }).catch(err => {
                        console.log(err)
                    })
            })
        },
        unpublish() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/offers/${this.$route.params.id}/unpublish`)
                    .then(res => {
                        this.offer = res.data.data

                    }).catch(err => {
                        console.log(err)
                    })
            })
        }
    },
    computed: {
        isAdvertiser() {
            return Number(this.$store.getters.user.role_id) === 1;
        },
        isWebmaster() {
            return Number(this.$store.getters.user.role_id) === 2;
        },
        isAuthor() {
            return Number(this.$store.getters.user.id) === Number(this.offer.user_id)
        }
    }
}
</script>