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
        let user =  JSON.parse(sessionStorage.getItem('user')) ?? null
        commit('setUser', user)
    }
}
export default {
    state, getters, mutations, actions
}