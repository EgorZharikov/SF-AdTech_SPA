const state = {
    user: null,
    balance: null,
}
const getters = {
    user: state => {
        return state.user
    },
    balance: state => {
        return state.balance
    }
}
const mutations = {
    setUser(state, user) {
        state.user = user
    },
    setBalance(state, balance) {
        state.balance = balance
    }
}
// const actions = {
//     getUserData({commit}) {
//             axios.get('/sanctum/csrf-cookie').then(response => {
//                 axios.post('/api/authentication')
//                     .then(res => {
//                         if (res.data.data.hasOwnProperty("name")) {
//                             commit('setUser', res.data.data)
//                         } else {
//                             commit('setUser', null)
//                         }
//                     }).catch(err => {
//                         commit('setUser', null)
//                     })
//             }) 
//     }
// }
const actions = {
    async getUserData({ commit, state }) {
        if (!state.user) {
            try {
                const res = await axios.get('/sanctum/csrf-cookie');
                const auth = await axios.post('/api/authentication')
                commit('setUser', auth.data.data)
                if (auth.data.data) {
                    commit('setBalance', auth.data.data.wallet.balance)
                }
            } catch (error) {
                console.error(error)
            }
        }
    }
}
export default {
    state, getters, mutations, actions
}