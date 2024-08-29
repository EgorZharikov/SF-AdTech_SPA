const state = {
    user: null
}
const getters = {
    user: state => {
        return state.user
    }
}
const mutations = {
    setUser(state, user) {
        state.user = user
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
            } catch (error) {
                console.error(error)
            }
        }
    }
}
export default {
    state, getters, mutations, actions
}