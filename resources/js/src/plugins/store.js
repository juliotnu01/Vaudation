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
        skeletonCardLoading: false,
        auditions:{},
        overlay:true
    },
    getters: {
        project: state => state.project,
        user: state => state.user,
        users: state => state.users,
        skeletonCardLoading: state => state.users,
        auditions: state => state.auditions,
        overlay: state => state.overlay  
    },
    mutations: {
        setOverlay(state, data){
            state.overlay = data
        },
        setProject(state, data){
            state.project = data
        },
        setUser(state, data){
            state.user = data
        },
         setUsers(state, data){
            state.users = data
        },
         setSkeletonCardLoading(state, data){
            state.skeletonCardLoading = data
        },
         setauditions(state, data){
            state.auditions = data
        }
    },
    actions: {},
});