import projectService from './services/projectService.js'
import userService from './services/userService.js'

export default  {
	
    projectService: new projectService(),
    userService: new userService()
	
}