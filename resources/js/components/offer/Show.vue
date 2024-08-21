<template>
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-7 fw-bold lh-1">title</h1>
                <p class="lead">content</p>
                <div class="col-md-5 col-lg-5 p-1 mb-4">
                    <div class="alert alert-success p-2" role="alert">
                        <div class="list-group-item d-flex justify-content-between">
                            <strong>Redirection award:</strong>
                            <strong>22222 ₽</strong>
                        </div>
                    </div>
                    <div class="alert alert-secondary p-2" role="alert">
                        <div class="list-group-item d-flex justify-content-between">
                            <strong>Topic:</strong>
                            <strong>topic name</strong>
                        </div>
                    </div>

                    <div class="alert alert-danger" role="alert">
                        errors
                    </div>

                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                  
                    <form method="post" action="">
                       
                        <button type="submit" class="btn btn-success btn-lg px-4 me-md-2 fw-bold">Subscribe</button>
                    </form>


                    <form method="post" action="">
   
                        <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                        <button type="submit" class="btn btn btn-dark btn-lg px-4">Unsubscribe</button>
                    </form>
                   
                    <a href="" class="btn btn-primary btn-lg px-4 me-3">Edit</a>

                    <form method="post" action="">

                        <button type="submit" class="btn btn btn-dark btn-lg px-4 me-3">Unpublish</button>
                    </form>

                    <form method="post" action="">

                        <button type="submit" class="btn btn btn-success btn-lg px-4">Publish</button>
                    </form>

                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="" alt="" width="324">
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {
        this.$watch(
            () => this.$route.params.id,
            (newId, oldId) => {
                console.log(newId)
            }
        )
    },
    methods: {
        getOffer() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get(`/api/offers/${$route.params.id}`)
                    .then(res => {
                        console.log(res.data.data)

                    }).catch(err => {
                        console.log(err)
                    })
            })
        }
    }
}
</script>