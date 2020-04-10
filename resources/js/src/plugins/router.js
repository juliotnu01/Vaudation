import Vue from 'vue'
import Router from 'vue-router'
import AuditionDashboard from '../../components/AuditionDashboard.vue'
import AuditionComponent from '../../components/AuditionComponent.vue'
import AuditionPersonComponent from '../../components/AuditionPersonComponent.vue'

Vue.use(Router)
export default new Router({
    routes: [{
            path: '/',
            name: 'dashboard',
            component: AuditionDashboard
        },
        {
            path: '/audition',
            name: 'audition',
            component: AuditionComponent
        },
        {
            path: '/:id_audition/audition-person',
            name: 'audition.person',
            component: AuditionPersonComponent
        },
    ]
})
