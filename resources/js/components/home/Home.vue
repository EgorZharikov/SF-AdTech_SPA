<template>
    <main>
        <div class="container col-xxl-8 mt-5 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="/img/title_logo.jpg" class="d-block mx-lg-auto img-fluid" alt="title_img" width="500"
                        loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">SF-AdTech</h1>
                    <p class="lead">SF-AdTech — это трекер трафика, созданный для организации взаимодействия компаний
                        (рекламодателей), которые хотят привлечь к себе на сайт посетителей и покупателей (клиентов), и
                        владельцев сайтов (веб-мастеров), на которые люди приходят, например, чтобы почитать новости или
                        пообщаться на форуме.</p>
                    <div v-if="!user" class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <router-link to="/registration" type="button"
                            class="btn btn-primary btn-lg px-4 me-md-2">Registration</router-link>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    computed: {
        user() {
        return this.$store.getters.user
    }
    },
    // mounted() {
    //     this.$nextTick(function () {
    //         this.$store.dispatch('getUserData')
    //     })
    // }
}
</script>
