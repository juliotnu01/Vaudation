import { store } from '../src/plugins/store.js'
export default class projectService {


    async get(user_id = '') {
        store.commit('setSkeletonCardLoading', true)
            let { data } = await axios(`/api/get-project/user/${user_id}`)
        store.commit('setProject', data)
        store.commit('setSkeletonCardLoading', false)
    }

    add(data, var_project_name, id_user) {
        const URL = `/api/save-project`
        data.forEach(async (item) => {
            var form = new FormData()
            form.append('project_name', var_project_name);
            form.append('id_user', id_user);
            form.append('character', JSON.stringify(item));
            form.append('script_file', item.script);
            try {
                axios.post(URL, form, { headers: { "Content-Type": "multipart/form-data" } })
            } catch (e) {
                console.log(e);
            }
        })
    }


}
