<template>
	<v-form v-model="valid">
		<div>
			<v-alert dismissible v-model="alert" type="success" v-if="res.status">
	        	{{res.message}}
	    	</v-alert>
	    </div>
		<v-container grid-list-md>
			<v-layout row wrap>
				<v-flex xs12 sm12 md12>
					<v-card flat>
						<v-card-title>
							<h2 style="font-size: 18px;">{{ title }}</h2>
						</v-card-title>
						<v-divider/>
						<v-flex v-for="(form,i) in formsControl" :key="i" :class="form.size">
							<v-flex v-if="form.type=='textbox'">
								<v-text-field
								:label="form.text"
								v-model="data[form.name]"
								:rules="form.rule ? [v => !!v || 'This field is required']:[]"
								:required="form.rule ? true:false"
							  ></v-text-field>
							</v-flex>
							<v-flex v-if="form.type=='email'">
								<v-text-field
								:label="form.text"
								v-model="data[form.name]"
								:rules="form.rule ? [v => !!v || 'E-mail is required',v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid']:[]"
								:required="form.rule ? true:false"
							  ></v-text-field>
							</v-flex>
							<v-flex v-if="form.type=='editor'">
								 <vue-editor id="editor1" :placeholder="form.text" v-model="data[form.name]" style="min-height: 200px;" ></vue-editor>
							</v-flex>
						</v-flex>
					</v-card>
				</v-flex>
			</v-layout>
			<v-btn @click="submit" color="primary" :disabled="!valid">
				{{id>0 ? 'update' : 'save'}}
			</v-btn>
			<v-btn @click="cancel" color="error">
				cancel
			</v-btn>
		</v-container>
	</v-form>
</template>
<script>
	var toolbars=
	[
		[
			'bold', 'italic', 'underline', 'strike',
			{ 'header': 1 }, 
			{ 'header': 2 },
			{ 'script': 'sub'},
			{ 'script': 'super' },
			{ 'indent': '-1'}, 
			{ 'indent': '+1' },
			{ 'list': 'ordered'}, { 'list': 'bullet' },
			'image'
		]
	]
	import { post,put } from 'axios'
	export default{
		name:'singleForm',
		props:[
			'formsControl',
			'data',
			'title',
			'reqUrl',
			'id'
		],
		data(){
			return{
				alert:false,
				valid: false,
				toolbar:toolbars,
				res:{
					status:false,
					message:''
				}
			}
		},
		methods:{
			submit(){
				if(this.id>0){
					axios.put(this.reqUrl+this.id,this.data).then((res)=>{
						if(res.data.status==true){
							this.alert=true
							this.res.status=res.data.status
							this.res.message=res.data.message
						}
					})
				}else{
					axios.post(this.reqUrl,this.data).then((res)=>{
						if(res.data.status==true){
							this.alert=true
							this.res.status=res.data.status
							this.res.message=res.data.message
						}
					})
				}
			},
			cancel(){
				window.history.back();
			}
		}
	}
</script>
<style type="text/css">
	#editor1{
		min-height: 200px;
	}
	.alert>div{
		width: 100% !important;
		text-align: left;
	}
	a.alert__dismissible{
		width: 10px !important;
		height: 10px !important;
		position: relative;
		right: 0px;
	}
</style>