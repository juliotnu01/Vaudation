import { store } from '../src/plugins/store.js'

export default class userService { 
	async get(id){
		let {data} = await axios(`/api/${id}/get-user-vaudition`)
        store.commit('setUser', data)

	}
    async getAll(id){
        let {data} = await axios(`/api/${id}/get-all-user-vaudition`)
        store.commit('setUsers', data)

    }
    async changeStatusUser(item){
        if (item.status_user == false) {
            item.status_user = 0
        }
        if (item.status_user == true) {
            item.status_user = 1
        }
        let {data} = await axios.put(`/api/${item.id}/change-status-user-vaudition`, item)
    }

    async selectedUser(character, user, note){
        const URL = '/api/contact-vauditioner'

        let {data} = await axios.post(URL, {character, user, note})
    }
}