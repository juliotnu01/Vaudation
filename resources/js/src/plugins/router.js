import Vue from 'vue'
import Router from 'vue-router'
import AuditionDashboard from '../../components/AuditionDashboard.vue'
import AuditionComponent from '../../components/AuditionComponent.vue'
import AuditionPersonComponent from '../../components/AuditionPersonComponent.vue'
import DashboardProyectComponent from '../../components/dashboardProyectComponent.vue'
import ProyectComponent from '../../components/ProyectComponent.vue'

Vue.use(Router)
export default new Router({
    routes: [
        {
            path: '/',
            name: 'dashboard.proyect',
            component: DashboardProyectComponent
        },
        {
            path: '/add-project',
            name: 'add.Proyect',
            component: ProyectComponent
        },
        {
            path: '/:id_project/dashboard-casting',
            name: 'dashboard.casting',
            component: AuditionDashboard
        },
        {
            path: '/:id_project/audition',
            name: 'audition',
            component: AuditionComponent
        },
        {
            path: '/project/:id_project/audition/:id_audition/audition-person',
            name: 'audition.person',
            component: AuditionPersonComponent
        },
    ]
})
