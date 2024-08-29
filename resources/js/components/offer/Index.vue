<template>
    <main>
        <div class="container text-center mt-5">
            <div class="row justify-content-center align-items-center">
                <div v-for="offer in offers" class="col-3 m-3">
                    <div class="card" style="width: 20rem;">
                        <img :src="offer.preview_image" class="card-img-top" alt="preview_image">
                        <div class="card-body">
                            <h5 class="card-title">{{ offer.title }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-success">Redirection award: {{ offer.award }} ₽</li>
                            <li class="list-group-item">Topic: {{ offer.topic.name }} </li>
                        </ul>
                        <div class="card-body">
                            <router-link class="btn btn-primary"
                                :to="{ name: 'offer.show', params: { id: offer.id } }">Explore</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    name: "offer.index",
    data() {
        return {
            offers: null
        }
    },
    methods: {
        getOffers() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/offers')
                    .then(res => {
                        this.offers = res.data.data
                        console.log(res.data.data)

                    }).catch(err => {
                        console.log(err)
                    })
            })
        }
    },
    mounted() {
        this.getOffers()
    }
}
</script>
