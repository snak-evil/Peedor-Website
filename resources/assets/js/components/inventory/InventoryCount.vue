<template>
	<div id="app">
		<!--breadcrumb component-->
		<v-toolbar dark color="white" fixed app style="margin-top: 40px;margin-bottom: 100px !important;height: 50px !important;box-shadow: none;padding-top: 5px; border-bottom: solid 1px #ccc !important;">
		    <v-toolbar-title>
		    	<v-breadcrumbs divider="/">
		        <v-breadcrumbs-item
		          v-for="item in breadcrumbs"
		          :key="item.text"
		          :disabled="item.disabled"
		        >
		          	<router-link v-if="item.url" :to="item.url">{{ item.text }}</router-link>
          			<span v-else>{{item.text}}</span>
		        </v-breadcrumbs-item>
		      </v-breadcrumbs>
		    </v-toolbar-title>
		    <v-spacer/>
		    <v-toolbar-items>
		      <v-btn color="primary" @click.prevent="preview">Preview</v-btn>
		    </v-toolbar-items>
		</v-toolbar>
		<!--Call form group component-->
		<group-form :form-groups="groups" :data="data"/>
		<v-container grid-list-md>
			<v-layout row wrap>
				<!--Product to count-->
				<v-flex xs12 sm8 md8>
					<v-card flat>
						<v-container grid-list-md>
							<v-layout row wrap>
								<v-flex xs12 sm8 md8>
									<v-text-field v-model="selectedProduct" label="Product"/>
								</v-flex>
								<v-flex xs12 sm2 md2>
									<v-text-field label="Count" v-model="countNumber" type="number"/>
								</v-flex>
								<v-flex xs12 sm2 md2>
									<v-btn color="success" @click="countItem(selectedProduct)" v-text="'Count'" class="white-text" :disabled="!valid"/>
								</v-flex>
							</v-layout>
						</v-container>
					</v-card>
					<v-divider/>
					<!--Call clickable row table component-->
					<clickable-row-table :headers="headers" :datas="items" :title="tbtitle" :selectedProduct="'name'" @change="selectProduct"/>
					<!--End table component-->
				</v-flex>
				<!--End product to count-->

				<!--Latest count list-->
				<v-flex xs12 sm4 md4>
					<v-list subheader>
			            <v-subheader>Last Counted Items</v-subheader>
				            <v-list-tile avatar v-for="(product,p) in products" :key="p">
				            	<v-list-tile-avatar>
				                  	{{product.qty}}
				                </v-list-tile-avatar>
			            		<v-list-tile-content>
				                	<v-list-tile-title v-html="product.name"/>
				              	</v-list-tile-content>
				              	<v-list-tile-action @click="products.splice(p,1)">
				                	<v-icon>remove_circle</v-icon>
				              	</v-list-tile-action>
				            </v-list-tile>
			          	</v-list>
				</v-flex>
				<!--End list-->
			</v-layout>
		</v-container>
	</div>
</template>
<script>
	import groupForm from '../forms/groupForm'
  	import saveCancelButtonBreadcrumb from '../breadcrumbs/saveCancelButtonBreadcrumb'
  	import clickableRowTable from '../data_tables/clickableRowTable'
	export default {
	
	components:{
		
		groupForm,
		saveCancelButtonBreadcrumb,
		clickableRowTable

	},
	
    data() {
    
	return {
		valid:false,
		groups:[
			{
				item:'General',size:'xs12 sm12 md12',formsControl:[
					{size:'xs12 sm6 md6',text:'Start Date',type:'date',rule:true,name:'startdate',menu:'dateMenu'},
					{size:'xs12 sm6 md6',text:'Start Time',type:'textbox',rule:false,name:'starttime'},
					{size:'xs12 sm12 md12',text:'Count Name',type:'textbox',rule:true,name:'countname'},
				]
			},
		],
		data:{image:''},//data to be get input from user
		tbtitle:'Click on item you want to count',
		headers: 
	    [
	        {
	          	text: 'Name',
	          	align: 'left',
	          	sortable: true,
	          	value: 'name'
	        },
	        { text: 'Date Time', value: 'datetime',align:'left' }
	    ],
	    items: 
      	[
	        {
	          	value: true,
	          	name: 'Product 1',
	          	datetime:'2018-04-29 00:06:07'
	        },
	        {
				value: true,
				name: 'Product 2',
	          	datetime:'2018-04-30 00:06:07'
	        },
	        {
				value: true,
				name: 'Product 3',
	          	datetime:'2018-05-01 00:06:07'
	        },
      	],
      	products:[
      		{name:'Product 1',qty:10},
      		{name:'Product 2',qty:5},
      		{name:'Product 3',qty:7}
      	],
      	selectedProduct:'dddd',
      	countNumber:'',
		breadcrumbs:[
	      {
	        text: 'Inventory Count',
	        disabled: false,
	        url:'/inventory/list'
	      },
	      {
	        text: 'Count',
	        disabled: false
	      }
	    ],
      }
    },
    watch:{
    	countNumber(){
    		if(this.countNumber>0){
    			this.valid=true
    		}else{
    			this.valid=false
    		}
    	},
    },
    methods:{
    	selectProduct(str){
    		this.selectedProduct=str
    	},
    	countItem(product){
    		var countItemArr={name:product,qty:this.countNumber}
    		this.products.push(countItemArr)
    	},
    	preview(){
    		this.$router.push('/inventory/preview')
    	}
    }
  }
</script>