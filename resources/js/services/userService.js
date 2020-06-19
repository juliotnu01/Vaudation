import { store } from '../src/plugins/store.js'
export default class userService { 

	async get(id){
		let {data} = await axios(`${id}/get-user-vaudition`)
        store.commit('setUser', data)

	}
}