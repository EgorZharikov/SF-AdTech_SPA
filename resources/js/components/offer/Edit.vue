<template>
    <main>
        <div class="container">
            <main v-if="offer">
                <div class="py-5 text-center">
                    <img class="d-block mx-auto mb-4" src="/img/creation_offer.png" alt="" width="120">
                    <h2>Edit advertising offer</h2>
                    <p class="lead">Fill the required fields to edit an advertising offer.</p>
                </div>

                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your wallet</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (₽)</span>
                                <strong> 0 </strong>
                            </li>
                        </ul>
                        <!-- @if($errors->has('walletError')) -->
                        <div class="alert alert-danger" role="alert">
                            Insufficient funds! <a href="">Please spread the word to help raise the balance.</a>
                        </div>
                        <!-- @endif -->
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <form class="needs-validation" action="" enctype="multipart/form-data" method="post">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="title" class="form-label">Title:</label>
                                    <input v-model="title" type="text" class="form-control" id="title" name="title"
                                        placeholder="Offer title" required>
                                    <div v-if="errors" class="form-text text-danger">
                                        <p v-for="error in errors.title">{{ error }}</p>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="url" class="form-label">Link to your website:</label>
                                    <input v-model="url" type="url" class="form-control" id="url" name="url"
                                        placeholder="https://example.com" required>
                                    <div v-if="errors" class="form-text text-danger">
                                        <p v-for="error in errors.url">{{ error }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="content" class="form-label">Main content:</label>
                                    <textarea v-model="content" class="form-control" value="" id="content" rows="10"
                                        name="content"></textarea>
                                    <div v-if="errors" class="form-text text-danger">
                                        <p v-for="error in errors.content">{{ error }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="topic" class="form-label">Topic:</label>
                                    <input v-model="topic" type="text" class="form-control" value="" id="topic"
                                        name="topic" placeholder="Enter topic your website" required>
                                    <div v-if="errors" class="form-text text-danger">
                                        <p v-for="error in errors.topic">{{ error }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>Preview image:</span>
                                    <div class="input-group mt-2">
                                        <input type="file" @change="selectImage" class="form-control" id="preview_image"
                                            name="preview_image">
                                    </div>
                                    <div v-if="errors" class="form-text text-danger">
                                        <p v-for="error in errors.preview_image">{{ error }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4">
                                    <span>Reward:</span>
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">₽</span>
                                        <input v-model="award" type="number" class="form-control" value=""
                                            aria-label="Amount" name="award" step=".1" pattern="\d*">
                                    </div>
                                    <div v-if="errors" class="form-text text-danger">
                                        <p v-for="error in errors.award">{{ error }}</p>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="form-check form-switch" style="display:contents;">
                                        <label class="form-check-label me-3" for="unique_ip"><strong>Unique
                                                ip:</strong></label>
                                        <input v-model="unique_ip" class="form-check-input" type="checkbox"
                                            id="unique_ip" name="unique_ip"
                                            style="float:none;margin-left:0.5rem;transform: scale(1.8);">
                                    </div>
                                </div>
                                <button @click.prevent="updateOffer" class=" w-100 btn btn-primary btn-lg mb-4"
                                    type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </main>
</template>
<script>
export default {
    name: "Offer.edit",
    data() {
        return {
            title: '',
            url: '',
            content: '',
            topic: '',
            preview_image: '',
            award: '',
            unique_ip: '',
            offer: '',
            errors: '',
            user: null,
        }
    },
    methods: {
        updateOffer() {
            console.log(this.title)
            let uniqueIp = this.unique_ip ? 1 : 0
            const data = new FormData();
            data.append('title', this.title);
            data.append('url', this.url);
            data.append('content', this.content);
            data.append('topic', this.topic);
            data.append('preview_image', this.preview_image);
            data.append('award', this.award);
            data.append('unique_ip', uniqueIp);
            data.append('_method', 'PATCH');
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post(`/api/offers/${this.$route.params.id}`, data)
                    .then(res => {
                        this.$router.push({ name: 'offer.index' })
                    }).catch(err => {
                        console.log(err)
                        this.errors = err.response.data.errors
                    })
            })
        },
        getOffer() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/offers/${this.$route.params.id}`)
                    .then(res => {
                        let userId = this.$store.getters.user ? this.$store.getters.user.id : 0


                        if (res.data.data.user_id === userId) {
                            this.offer = res.data.data
                            this.title = res.data.data.title
                            this.url = res.data.data.url
                            this.content = res.data.data.content
                            this.topic = res.data.data.topic.name
                            this.award = res.data.data.award
                            this.unique_ip = Boolean(res.data.data.unique_ip)
                        } else {
                            this.$router.push({ name: 'error.404' })
                        }
                        
                    }).catch(err => {
                        console.log(err)
                        this.errors = err
                        this.errors = err.response.data.errors
                    })
            })
        },
        selectImage(event) {
            this.preview_image = event.target.files[0];
        }
    },
    computed: {
        user() {
            return this.$store.getters.user
        },
        offer() {
           return this.offer
        }
    },
    mounted() {
        this.getOffer() 
    }
}
</script>