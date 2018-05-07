<template>
	<v-form v-model="valid" style="margin-top: 30px;">
			<v-tabs dark color="blue" show-arrows>
			  <v-tabs-slider color="red"></v-tabs-slider>
			  <v-tab v-for="(tab,i) in formTabs" :key="i" :href="'#tab-' + i">
				{{ tab.item }}
			  </v-tab>
			  <v-tabs-items>
				<v-tab-item v-for="(tab,i) in formTabs" :key="i" :id="'tab-' + i">
					<v-card flat>
						<v-container grid-list-md>
							<v-layout row wrap>
								<v-flex v-for="(form,i) in tab.formsControl" :key="i" :class="form.size">
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
								</v-flex>
							</v-layout>
						</v-container>
					</v-card>
				</v-tab-item>
			  </v-tabs-items>
			</v-tabs>
			<v-btn @click="submit" :disabled="!valid">
				submit
			</v-btn>
	</v-form>
</template>
<script>
	export default{
		name:'formTabs',
		props:[
			'formTabs',
			'data'
		],
		data(){
			return{
				valid: false,
				model:''
			}
		},
		methods:{
			submit(){
				alert('submit')
			}
		}
	}
</script>