<template>
    <div class="container text-center">
        <h4 class="mb-3 text-primary">Overall:</h4>
        <div class="row align-items-center">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Offer title</th>
                        <th scope="col">Subscriptions now</th>
                        <th scope="col">Subscriptions total</th>
                        <th scope="col">Redirects</th>
                        <th scope="col">Redirect award</th>
                        <th scope="col">Costs ₽</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @foreach ($statistics as $statistic) -->
                    <tr>
                        <th scope="row">id</th>
                        <td>title</td>
                        <td>subscriptionsNow</td>
                        <td>subscriptions_count</td>
                        <td>redirect_count</td>
                        <td>award</td>
                        <td>total</td>
                    </tr>
                    <!-- @endforeach -->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th scope="row">Σ 999</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center d-inline-flex">
            <div class="justify-content-center d-inline-flex">
                <form>
                    <input type="date" name="date" class="m-4" style="transform: scale(1.3);" />
                    <button type="submit" name="day" class="btn btn-outline-dark ms-1">Day</button>
                    <button type="submit" name="month" class="btn btn-outline-dark ms-1">Month</button>
                    <button type="submit" name="year" class="btn btn-outline-dark ms-1">Year</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row align-items-center">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Offer title</th>
                        <th scope="col">Subscriptions now</th>
                        <th scope="col">Subscriptions total</th>
                        <th scope="col">Redirects</th>
                        <th scope="col">Redirect award</th>
                        <th scope="col">Costs ₽</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @foreach ($dateStatistics as $dateStatistic ) -->
                    <tr>
                        <th scope="row">offer_id</th>
                        <td>offer_title</td>
                        <td>subscriptions_now</td>
                        <td>subscriptions_now</td>
                        <td>redirects_now</td>
                        <td>award</td>
                        <th scope="row">totals</th>
                    </tr>
                    <!-- @endforeach -->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th scope="row">Σ 9999</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>