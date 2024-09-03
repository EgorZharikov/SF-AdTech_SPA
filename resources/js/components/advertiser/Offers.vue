<template>
    <main>
        <div class="container text-center">
            <h1 class="m-5">Offers</h1>
            <div v-if="offers" class="row justify-content-center align-items-center">
                <!-- @foreach ($offers as $offer) -->
                <div v-for="offer in offers" class="col-3 m-3">
                    <div class="card" style="width: 20rem;">
                        <img :src="offer.preview_image" class="card-img-top" alt="preview_image">
                        <div class="card-body">
                            <h5 class="card-title">{{ offer.title }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-success">Redirection award: {{ offer.award }} ₽</li>
                            <li class="list-group-item">Topic: {{ offer.topic.name }}</li>
                            <!-- @switch($offer->status)
                        @case(0) -->
                            <li v-if="Number(offer.status) === 0" class="list-group-item text-black">Status: unpublished
                            </li>
                            <!-- @break
                        @case(1) -->
                            <li v-if="Number(offer.status) === 1" class="list-group-item text-success">Status: published
                            </li>
                            <!-- @break
                        @case(2) -->
                            <li v-if="Number(offer.status) === 2" class="list-group-item text-warning">Status: suspend
                                (replenish the balance)</li>
                            <!-- @break
                        @endswitch -->
                            <li class="list-group-item text-primary">id: {{ offer.id }}</li>
                        </ul>
                        <div class="card-body">
                            <router-link class="btn btn-primary"
                                :to="{ name: 'offer.show', params: { id: offer.id } }">Explore</router-link>
                        </div>
                    </div>
                </div>
                <!-- @endforeach -->
            </div>
            <!-- {{ $offers -> links() }} -->
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            offers: null,
        }
    },
    methods: {
        getOffers() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/advertiser/offers')
                    .then(res => {
                        this.offers = res.data.offers

                    }).catch(err => {

                    })
            })
        }
    },
    created() {
        this.getOffers()
    }
}
</script>