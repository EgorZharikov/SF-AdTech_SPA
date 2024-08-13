<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <router-link to="/login">login</router-link>
                <router-link to="/registration">registration</router-link>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
