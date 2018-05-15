import axios from 'axios'
export default{
	state: {
		success: null,
		error: null,
		StateData:[],
		username:null
	},
	setStateData(message){
		this.state.StateData = message
	},
	setSuccess(message){
		this.state.success = message

		setTimeout(() => {
			this.removeSuccess() 
		},2000)
	},
	setError(message){
		this.state.error = message 
		setTimeout(() => {
			this.removeError() 
		},2000)
	},
	removeSuccess(message){
		this.state.success = null
	},
	removeError(message){
		this.state.error = null
	},
	setLoginName(username){
		this.state.username=username
	}
}