require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import vuetify from './src/plugins/vuetify'
import router from './src/plugins/router'
import Vuex from 'vuex'
import { store } from './src/plugins/store'
import VueSweetalert2 from 'vue-sweetalert2'
import {mapState} from 'vuex'
import 'sweetalert2/dist/sweetalert2.min.css'
 

router.beforeEach((to, from, next) => {
    next();
    console.log({to, from, next})
})

Vue.use(VueSweetalert2);
Vue.use(Vuex);
Vue.component('auth-component', require('./components/dashboardInitComponent.vue').default);
Vue.component('loading', require('./components/loadingComponent.vue').default);
const app = new Vue({
    vuetify,
    router,
    store,
    computed: {
        ...mapState(['services'])
    },
}).$mount('#app');


