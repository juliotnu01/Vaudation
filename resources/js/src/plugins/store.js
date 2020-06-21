import Vue from 'vue';
import Vuex from 'vuex';
import services from '../../services.js'

Vue.use(Vuex);

export const store =  new Vuex.Store({
    state: {
        services,
        project: [],
        user: {},
        users:[],
    },
    getters: {
        project: state => state.project,
        user: state => state.user,
        users: state => state.users
    },
    mutations: {
        setProject(state, data){
            state.project = data
        },
        setUser(state, data){
            state.user = data
        },
         setUsers(state, data){
            state.users = data
        }
    },
    actions: {},
});