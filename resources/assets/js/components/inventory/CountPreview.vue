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
		      <v-btn color="primary" @click.prevent="$router.push('/inventory/count')">Resume</v-btn>
		      &nbsp;
		      <v-btn color="primary" @click.prevent="$router.push('/inventory/detail/1')">Complete</v-btn>
		    </v-toolbar-items>
		</v-toolbar>
		<!--Call clickable row table component-->
		<simple-table :headers="headers" :datas="items" :title="tbtitle"/>
		<!--End table component-->
	</div>
</template>
<script>
	import simpleTable from '../data_tables/simpleTable'
	export default{
		components:{
			simpleTable
		},
		data(){
			return{
				tbtitle:'Item count preview',
				headers: 
			    [
			        {
			          	text: 'Items List',
			          	align: 'left',
			          	sortable: true,
			          	value: 'name'
			        },
			        { text: 'Expected', value: 'expected',align:'left' },
			        { text: 'Counted', value: 'counted',align:'left' }
			    ],
			    items: 
		      	[
			        {
			          	value: true,
			          	name: 'Product 1',
			          	expected:10,
			          	counted:10
			        },
			        {
						value: true,
						name: 'Product 2',
			          	expected:15,
			          	counted:10
			        },
			        {
						value: true,
						name: 'Product 3',
			          	expected:10,
			          	counted:11
			        },
		      	],
				breadcrumbs:[
				    {
				        text: 'Inventory Count',
				        disabled: false,
				        url:'/inventory/list'
				    },
				    {
				        text: 'Count',
				        disabled: false
				    },
				    {
				        text: 'Preview',
				        disabled: false
				    }
			    ],
			}
		}
	}
</script>