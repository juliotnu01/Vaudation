import Vue from 'vue';
import Vuex from 'vuex';
import services from '../../services.js'

Vue.use(Vuex);

export const store =  new Vuex.Store({
    state: {
        services,
        project: [],
        user: {},
    },
    getters: {
        project: state => state.project,
        user: state => state.user
    },
    mutations: {
        setProject(state, data){
            state.project = data
        },
        setUser(state, data){
            state.user = data
        }
    },
    actions: {},
});