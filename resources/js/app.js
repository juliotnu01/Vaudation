require('./bootstrap');

import Vue from 'vue'
import vuetify from './src/plugins/vuetify'
import router from './src/plugins/router'
import Vuex from 'vuex'
import { store } from './src/plugins/store'

Vue.use(Vuex)
window.Vue = require('vue');


const app = new Vue({
    vuetify,
    router,
    store
}).$mount('#app');
