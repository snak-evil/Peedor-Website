<template>
	<div class="app">
		<v-card flat>
			<v-card-title>
		        {{title}}
		        <v-spacer></v-spacer>
		        <v-text-field
		          append-icon="search"
		          label="Search"
		          single-line
		          hide-details
		          v-model="search"
		        ></v-text-field>
		    </v-card-title>
			<v-data-table v-bind:headers="headers" :items="datas" v-bind:search="search" class="elevation-1" sort-desc="true">
				<template slot="items" slot-scope="props">
					<td class="text-xs-left" v-for="index in headers">
						<img v-if="index.value=='image'" :src="props.item.image ? props.item.image:'/images/icon/no-image.png'" style="width: auto;max-width: 30px;height: auto;max-height: 30px;">
						<span v-if="index.action" @click.prevent="$router.push(url+'/'+props.item[index.value])" style="cursor:pointer;color:blue;">
							<i class="material-icons">remove_red_eye</i>
						</span>
						<span v-else v-html="props.item[index.value]"></span>

					</td>
				</template>
			</v-data-table>
		</v-card>
	</div>
</template>
<script>
	export default{
		props:[
			'headers',
			'datas',
			'selectedProduct',
			'title',
			'url'
		],
		data(){
			return{
				search:'',
			}
		},
		methods:{
			selectRow(str){
				this.$emit('change',str)
			}
		}
	}
</script>		