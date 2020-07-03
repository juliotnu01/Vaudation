import { store } from '../src/plugins/store.js'
export default class auditionService {

    async get(id_project) {
        store.commit('setSkeletonCardLoading', true)
        let  {data} = await  axios(`/api/${id_project}/get-character`)
        store.commit('setauditions', data)
        store.commit('setSkeletonCardLoading', false)
    }

}
