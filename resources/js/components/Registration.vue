<template>
    <div class="row account-card align-items-center" :style="{height: 100 + 'vh'}">
        <div class="col col-md-4 offset-md-4">
            <div class="account-logo text-center">
                <h3 class="h3 mb-3 fw-normal">Please sign up</h3>
            </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select id="role_id" class="form-select" name="role_id">
                                    <option value="1">advertiser</option>
                                    <option value="2">webmaster</option>
                                </select>
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="InputPassword">
                </div>
                <div class="mb-3">
                    <label for="inputConfirmPassword" class="form-label">Confirm password</label>s
                    <input type="password" name="confirm" class="form-control" id="inputConfirmPassword">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="signup" id="signIn" class="btn btn-primary">Отправить</button>
                </div>
                <div class="alert alert-danger mt-3" role="alert">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Registration",
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
