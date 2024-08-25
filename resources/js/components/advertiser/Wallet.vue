<template>
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col-sm-3 m-3">
                <div class="card d-flex justify-content-center bg-dark" style="width: 20rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-bg-success">
                            <h4>Balance: 200 ₽</h4>
                        </li>
                    </ul>
                    <form>
                        <div class="card-body d-flex justify-content-center" style="width: 20rem;">
                            <input type="number" class="form-control px-5" aria-label="Amount" name="amount" value=""
                                step="1" pattern="\d*">
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <button type="submit" name="replenish"
                                class="btn btn-outline-success px-4 me-4">Replenish</button>
                            <button type="submit" name="withdraw"
                                class="btn btn-outline-success px-4 me-4">Withdraw</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- @if($errors->has('walletError')) -->
            <div class="col-sm-3 m-3">
                <div class="alert alert-warning" role="alert">
                    errors
                </div>
            </div>
            <!-- @endif -->
        </div>
    </div>
</template>