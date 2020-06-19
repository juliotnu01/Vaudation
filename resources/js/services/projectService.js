import { store } from '../src/plugins/store.js'
export default class projectService {


    async get() {
        let { data } = await axios('/get-project')
        store.commit('setProject', data)
    }

    add(data, var_project_name) {
        console.log({var_project_name})
        const URL = `save-project`
        data.forEach(async (item) => {
            var form = new FormData()
            form.append('project_name', var_project_name);
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
