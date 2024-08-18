import { createStore } from 'vuex'
import Auth from './modules/auth'

const store = createStore({
    state () {
      return {
        count: 0
      }
    },
    mutations: {
      increment (state) {
        state.count++
      }
    },
    modules: {
      Auth
    }
  })

export default store;