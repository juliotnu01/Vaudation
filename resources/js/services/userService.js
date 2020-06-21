import { store } from '../src/plugins/store.js'
export default class userService { 

	async get(id){
		let {data} = await axios(`${id}/get-user-vaudition`)
        store.commit('setUser', data)

	}

    async getAll(){
        let {data} = await axios(`get-all-user-vaudition`)
        store.commit('setUsers', data)

    }

    async changeStatusUser(item){
        if (item.status_user == false) {
            item.status_user = 0
        }
        if (item.status_user == true) {
            item.status_user = 1
        }
        let {data} = await axios.put(`${item.id}/change-status-user-vaudition`, item)


    }
}