<template>
	<v-form v-model="valid">
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
									<v-flex v-if="form.type=='image'">
										<div class="helper"></div><!--
										  	--><div class="drop display-inline align-center" @dragover.prevent @drop="onDrop">
										    <div class="helper"></div><!--
											--><label v-if="!image" class="btn-img display-inline">
											        SELECT OR DROP AN IMAGE
											        <input type="file" name="image" @change="onChange">
										      	</label><!--
										      --><div class="hidden display-inline align-center" v-else v-bind:class="{ 'image': true }">
										        <img :src="image" alt="" class="img" />
										        <br>
										        <br>
										        <button class="btn-img" @click="removeFile">REMOVE</button>
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
	</v-form>
</template>
<script>
	export default{
		name:'formGroups',
		props:[
			'formGroups',
			'data'
		],
		data(){
			return{
				valid: false,
				model:false,
				image:'',
			}
		},
		methods:{
			onDrop: function(e) {
				e.stopPropagation();
				e.preventDefault();
				var files = e.dataTransfer.files;
				this.createFile(files[0]);
			},
			onChange(e) {
				var files = e.target.files;
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
				this.image = '';
			}
		}
	}
</script>