<template>
	<div id="app">
		<new-button-breadcrumb :breadcrumbs="breadcrumbs" :url="'/inventory/count'"/>
		<!--Call table component-->
		<simple-table :headers="headers" :datas="items" :url="'/inventory/detail'" :title="tbtitle"/>
		<!--End table component-->
	</div>
</template>
<script>
	import newButtonBreadcrumb from '../breadcrumbs/newButtonBreadcrumb'
	import simpleTable from '../data_tables/simpleTable'
	export default{
		components:{
			newButtonBreadcrumb,
			simpleTable
		},
		data () {
		    return {
			    search: '',
			    tbtitle:'Inventory Count List',
			    headers: 
			    [
			        {
			          	text: 'Name',
			          	align: 'left',
			          	sortable: true,
			          	value: 'name'
			        },
			        { text: 'Date Time', value: 'datetime',align:'left' },
			        { text: 'Action',action:true, value: 'id',align:'left' }
			    ],
			    items: 
		      	[
			        {
			        	id:1,
			          	value: true,
			          	name: 'Count 1',
			          	datetime:'2018-04-29 00:06:07'
			        },
			        {
			        	id:2,
						value: true,
						name: 'Count 2',
			          	datetime:'2018-04-30 00:06:07'
			        },
			        {
			        	id:3,
						value: true,
						name: 'Count 3',
			          	datetime:'2018-05-01 00:06:07'
			        }
		      	],
		      	breadcrumbs:[
		      		{
		        		text: 'Inventory count',
		        		disabled: false
			      	},
			      	{
			        	text: 'List',
			        	disabled: false
			      	}
		    	]
		    }
		},
	}
</script>