<template>
    <main>
        <div class="container text-center">
            <h1 class="m-5">Statistics</h1>
            <h4 class="mb-3 text-primary">Overall:</h4>
            <div class="row row justify-content-end">
                <div class="col-1 mb-2">
                    <a @click.prevent="getStatistics" href=""><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" fill="cornflowerblue" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                        </svg></a>
                </div>
            </div>
            <div class="row align-items-center">
                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col">Referal code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Offer award</th>
                            <th scope="col">Redirects</th>
                            <th scope="col">Service fee</th>
                            <th scope="col">Award ₽</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- @foreach ($dateStatistics as $dateStatistic) -->
                        <tr v-for="totalStat in totalStats">
                            <th scope="row">{{ totalStat.referal_link }}</th>
                            <td class="text-success" v-if="totalStat.status === 1">subscribed</td>
                            <td class="text-warning" v-if="totalStat.status === 0">unsubscribed</td>
                            <td>{{ totalStat.offer_award }}</td>
                            <td>{{ totalStat.redirects_count }}</td>
                            <td>{{ totalStat.fee }}</td>
                            <th scope="row"> {{ totalStat.award }}
                            </th>
                        </tr>
                        <!-- @endforeach -->
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th scope="row">Σ {{ this.totalAward }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row align-items-center d-inline-flex">
                <div class="justify-content-center d-inline-flex">
                    <form>
                        <input v-model="userDate" type="date" name="date" class="m-4" style="transform: scale(1.3);" />
                        <button @click.prevent="dayStatistics" type="submit" name="day"
                            class="btn btn-outline-dark ms-1">Day</button>
                        <button @click.prevent="monthStatistics" type="submit" name="month"
                            class="btn btn-outline-dark ms-1">Month</button>
                        <button @click.prevent="yearStatistics" type="submit" name="year"
                            class="btn btn-outline-dark ms-1">Year</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row align-items-center">
                <table class="table border">
                    <thead>
                        <tr>
                            <th scope="col">Referal code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Offer award</th>
                            <th scope="col">Redirects</th>
                            <th scope="col">Service fee</th>
                            <th scope="col">Award</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- @foreach ($dateStatistics as $dateStatistic) -->
                        <tr v-for="dateStat in dateStats">
                            <th scope="row">{{ dateStat.referal_link }}</th>
                            <td class="text-success" v-if="dateStat.status === 1">subscribed</td>
                            <td class="text-warning" v-if="dateStat.status === 0">unsubscribed</td>
                            <td>{{ dateStat.offer_award }}</td>
                            <td>{{ dateStat.redirects_count }}</td>
                            <td>{{ dateStat.fee }}</td>
                            <th scope="row">{{ dateStat.award }}
                            </th>
                        </tr>
                        <!-- @endforeach -->
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th scope="row">Σ {{ this.dateAward}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data() {
        return {
            totalStats: null,
            totalAward: null,
            dateStats: null,
            dateAward: null,
            userDate: null,
        }
    },
    methods: {
        getStatistics() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.get('/api/webmaster/statistics')
                    .then(res => {
                        this.totalStats = res.data.statistics
                        this.totalAward = res.data.totalAward

                    }).catch(err => {

                    })
            })
        },
        dayStatistics() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/webmaster/statistics', {date: this.userDate, day: true})
                    .then(res => {
                        this.dateStats = res.data.dateStatistics
                        this.dateAward = res.data.dateAward

                    }).catch(err => {

                    })
            })
        },
        monthStatistics() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/webmaster/statistics', { date: this.userDate, month: true })
                    .then(res => {
                        this.dateStats = res.data.dateStatistics
                        this.dateAward = res.data.dateAward

                    }).catch(err => {

                    })
            })
        },
        yearStatistics() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/webmaster/statistics', { date: this.userDate, year: true })
                    .then(res => {
                        this.dateStats = res.data.dateStatistics
                        this.dateAward = res.data.dateAward

                    }).catch(err => {

                    })
            })
        }
    },
    created() {
        this.getStatistics()
    }
}
</script>