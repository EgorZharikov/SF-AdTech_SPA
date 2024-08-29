<template>
    <main>
        <div class="container text-center">
            <h1 class="m-5">Profile</h1>
            <div class="row justify-content-end">
                <div v-if="profile" class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">{{ profile.name }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">{{ profile.email }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Role</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">advertiser</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Registration date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">{{ new Date(profile.created_at) }}</div>
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
            profile: null,
        }
    },
    methods: {
        getProfile() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/advertiser/profile')
                    .then(res => {
                        console.log(res)
                        this.profile = res.data

                    }).catch(err => {
                        console.log(err)
                    })
            })
        }
    },
    created() {
        this.getProfile()
    }
}
</script>