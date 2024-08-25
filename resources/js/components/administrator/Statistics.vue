<template>
    <div class="container text-center">
        <h4 class="mb-3 text-primary">Overall:</h4>
        <div class="row align-items-center">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">Generated ref_link</th>
                        <th scope="col">Generated ref_link (total)</th>
                        <th scope="col">Created offers</th>
                        <th scope="col">Publicated offers</th>
                        <th scope="col">Redirects success</th>
                        <th scope="col">Redirects fail</th>
                        <th scope="col">Income ₽</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @foreach ($statistics as $statistic) -->
                    <tr>
                        <td>reflink_count</td>
                        <td>reflink_total</td>
                        <td>offers_created</td>
                        <td>offers_publicated</td>
                        <td>redirectsSuccess</td>
                        <td>redirectsFail</td>
                        <td>total_inccome</td>
                    </tr>
                    <!-- @endforeach -->
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
                        <th scope="col">Generated ref_link</th>
                        <th scope="col">Generated ref_link (total)</th>
                        <th scope="col">Created offers</th>
                        <th scope="col">Publicated offers</th>
                        <th scope="col">Redirects success</th>
                        <th scope="col">Redirects fail</th>
                        <th scope="col">Income ₽</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @foreach ($dateStatistics as $dateStatistic) -->
                    <tr>
                        <td>reflink_count</td>
                        <td>reflink_total</td>
                        <td>offers_created</td>
                        <td>offers_publicated</td>
                        <td>redirect_succes</td>
                        <td>redirectsFail</td>
                        <td>income</td>
                    </tr>
                    <!-- @endforeach -->
                </tbody>
            </table>
        </div>
    </div>
</template>