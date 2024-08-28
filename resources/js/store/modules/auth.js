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
const actions = {
    getUserData({commit}) {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/authentication')
                    .then(res => {
                        if (res.data.data.hasOwnProperty("name")) {
                            commit('setUser', res.data.data)
                        } else {
                            commit('setUser', null)
                        }
                    }).catch(err => {
                        commit('setUser', null)
                    })
            }) 
    }
}
export default {
    state, getters, mutations, actions
}