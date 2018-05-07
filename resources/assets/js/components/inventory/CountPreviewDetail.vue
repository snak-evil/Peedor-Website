<template id="{{ $route.params.id }}">
	<div id="app">
		<!--breadcrumb component-->
		<simple-breadcrumb :breadcrumbs="breadcrumbs"/>
		<!--Call table component-->
		<simple-table :headers="headers" :datas="items" :title="tbtitle"/>
		<!--End table component-->
	</div>
</template>
<script>
	import simpleTable from '../data_tables/simpleTable'
	import simpleBreadcrumb from '../breadcrumbs/simpleBreadcrumb'
	export default{
		props:[
			'id'
		],
		components:{
			simpleTable,
			simpleBreadcrumb
		},
		data(){
			return{
				tbtitle:'Item count detail',
				headers: 
			    [
			        {
			          	text: 'Items List',
			          	align: 'left',
			          	sortable: true,
			          	value: 'name'
			        },
			        { text: 'Expected', value: 'expected',align:'left' },
			        { text: 'Counted', value: 'counted',align:'left' },
			        { text: 'Unit', value: 'unit',align:'left' },
			        { text: 'Cost', value: 'cost',align:'left' }
			    ],
			    items: 
		      	[
			        {
			          	value: true,
			          	name: 'Product 1',
			          	expected:10,
			          	counted:10,
			          	unit:0,
			          	cost:0
			        },
			        {
						value: true,
						name: 'Product 2',
			          	expected:15,
			          	counted:10,
			          	unit:-5,
			          	cost:-50
			        },
			        {
						value: true,
						name: 'Product 3',
			          	expected:10,
			          	counted:11,
			          	unit:1,
			          	cost:10
			        },
		      	],
				breadcrumbs:[
				    {
				        text: 'Inventory Count',
				        disabled: false,
				        url:'/inventory/list'
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