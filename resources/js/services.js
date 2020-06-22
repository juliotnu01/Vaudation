import projectService from './services/projectService.js'
import userService from './services/userService.js'
import auditionService from './services/auditionService.js'

export default  {
	
    projectService: new projectService(),
    userService: new userService(),
	auditionService: new auditionService()
}