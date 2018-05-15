<template>
	<v-form v-model="valid">
		<div>
			<!-- <v-alert color="success" transition="scale-transition" value='true' v-if="flash.success">
	          	{{flash.success}}
	      	</v-alert>
	      	<v-alert color="error" transition="scale-transition" value='true' v-if="flash.error">
	          	{{flash.error}}
	      	</v-alert> -->
			<!-- <v-alert dismissible v-model="alert" type="success" v-if="res.status">
	        	{{res.message}}
	    	</v-alert> -->
	    	<v-snackbar v-if="flash.success || flash.error ? snackbar=true : snackbar=false" color="flass.success ? green : red"
		        :timeout="timeout"
		        :top="true"
		        :bottom="false"
		        :right="false"
		        :left="x === 'left'"
		        :multi-line="mode === 'multi-line'"
		        :vertical="mode === 'vertical'"
		        v-model="snackbar"
		      >
		        {{ flash.success ? flash.success : flash.error}}
		        <!-- <v-icon style="cursor: pointer;" dark right @click.native="snackbar = false">remove_circle</v-icon> -->
		    </v-snackbar>
	    </div>
		<v-container grid-list-md>
			<v-layout row wrap>
				<v-flex v-for="(group,i) in formGroups" :key="i" :class="group.size">
					<v-card flat >
						<v-card-title>
							<h2 style="font-size: 18px;">{{ group.item }}</h2>
						</v-card-title>
						<v-divider/>
						<v-container grid-list-md>
							<v-layout row wrap>
								<v-flex v-for="(form,f) in group.formsControl" :key="f" :class="form.size">
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
									<v-flex v-if="form.type=='select'">
										<v-select :label="form.text"  :rules="form.rule ? [v => !!v || 'This field is required']:[]"
										:required="form.rule ? true:false" v-model="data[form.name]" :items="data[form.items]" autocomplete></v-select>
									</v-flex>
									<v-flex v-if="form.type=='editor'">
										 <vue-editor id="editor1" :placeholder="form.text" v-model="data[form.name]" style="min-height: 200px;" ></vue-editor>
									</v-flex>
									<v-flex v-if="form.type=='image'">
										<div class="helper"></div><!--
										  	--><div class="drop display-inline align-center" @dragover.prevent @drop="onDrop">
										    <div class="helper"></div><!--
											--><label v-if="!data[form.name]" class="btn-img display-inline">
											        SELECT OR DROP AN IMAGE
											        <input type="file" name="data[form.name]"@change="onChange">
										      	</label><!--
										      --><div class="hidden display-inline align-center" v-else v-bind:class="{ 'image': true }">
										        <img :src="data[form.name]" alt="" class="img" />
										        <br>
										        <br>
										        <v-btn color="error" @click="removeFile">REMOVE</v-btn>
										      </div>
										    </label>
										  </div>
									</v-flex>
									<v-flex v-if="form.type=='date'">
										<v-menu
								          lazy
								          :close-on-content-click="true"
								          v-model="data[form.menu]"
								          transition="scale-transition"
								          offset-y
								          full-width
								          :nudge-right="40"
								          max-width="290px"
								          min-width="290px"
								        >
								          <v-text-field
								            slot="activator"
								            :label="form.text"
								            v-model="data[form.name]"
								            prepend-icon="event"
								            readonly
								          ></v-text-field>
								          <v-date-picker v-model="data[form.name]" no-title scrollable actions>
								            <template slot-scope="{ save, cancel }">
								            </template>
								          </v-date-picker>
								        </v-menu>
									</v-flex>
								</v-flex>
							</v-layout>
						</v-container>
					</v-card>
				</v-flex>
			</v-layout>
		</v-container>
		<v-btn @click="submit" color="primary" :disabled="!valid">
				{{id>0 ? 'update' : 'save'}}
			</v-btn>
			<v-btn @click="cancel" color="error">
				cancel
			</v-btn>
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
	import Flash from '../../helper/flash'
	import { post,put } from 'axios'
	export default{
		name:'formGroups',
		props:[
			'formGroups',
			'data',
			'title',
			'reqUrl',
			'id'
		],
		data(){
			return{
				valid: false,
				model:false,
				image:'',
				alert:false,
				toolbar:toolbars,
				res:{
					status:false,
					message:''
				},
				flash:Flash.state,
				snackbar: false,
				y: 'top',
				x: null,
				mode: '',
				timeout: 7000,
			}
		},
		methods:{
			submit(){
				if(this.id>0){
					axios.put(this.reqUrl+this.id,this.data).then((res)=>{
						if(res.data.status==true){
							this.alert=true
							this.res.status=res.data.status
							Flash.setSuccess(res.data.message)
							//this.res.message=res.data.message
						}
					})
				}else{
					axios.post(this.reqUrl,this.data).then((res)=>{
						if(res.data.status==true){
							this.alert=true
							this.res.status=res.data.status
							Flash.setSuccess(res.data.message)
							this.$router.push('/admin'+this.reqUrl+'act/'+res.data.id)
						}
					})
				}
			},
			cancel(){
				this.$router.push('/admin'+this.reqUrl+'list')
			},
			onDrop: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.dataTransfer.files;
				this.createFile(files[0]);
			},
			onChange(e) {
				var files = e.target.files;
				this.data.image=files[0]
				this.createFile(files[0]);
			},
			createFile(file) {
				if (!file.type.match('image.*')) {
				  alert('Select an image');
				  return;
				}
				var img = new Image();
				var reader = new FileReader();
				var vm = this;

				reader.onload = function(e) {
				  vm.image = e.target.result;
				  vm.data.image=vm.image
				}
				reader.readAsDataURL(file);
			},
			removeFile() {
				this.data.image = '';
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