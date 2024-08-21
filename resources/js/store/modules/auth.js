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
        let user = JSON.parse(sessionStorage.getItem('user')) ?? null;
        if (user) {
            commit('setUser', user)
        } else {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/authentication')
                    .then(res => {
                        if (res.data.hasOwnProperty("name")) {
                            sessionStorage.setItem('user', JSON.stringify(res.data))
                            commit('setUser', res.data)
                        } else {
                            commit('setUser', null)
                        }
                    }).catch(err => {
                        commit('setUser', null)
                    })
            })
        }  
        
    }
}
export default {
    state, getters, mutations, actions
}