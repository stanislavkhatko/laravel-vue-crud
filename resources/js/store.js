import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {},
    },
    mutations: {
        setUser: (state, data) => state.user = data,
        unsetUser: (state) => state.user = {},
    },
    methods: {},
    actions: {},
    getters: {
        userRole(state) {
            return state.user ? state.user.role : null;
        },
        isAdmin(state) {
            return state.user ? state.user.is_admin : false;
        },
        userName(state) {
            return state.user ? state.user.first_name : null;
        },
    }
})
