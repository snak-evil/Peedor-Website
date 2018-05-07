<template>
	<div id="app">
		<new-button-breadcrumb :breadcrumbs="breadcrumbs" :url="'/admin/post/create'"/>
		<!--Call table component-->
		<simple-table :headers="headers" :datas="items" :url="getUrl" :title="tbtitle"/>
		<!--End table component-->
	</div>
</template>
<script type="text/javascript">
	
	import newButtonBreadcrumb from '../breadcrumbs/newButtonBreadcrumb'
	import simpleTable from '../data_tables/simpleTable'
	export default{
		components:{
			newButtonBreadcrumb,
			simpleTable
		},
		data () {
		    return {
		    	reqUrl:'/post',
		    	getUrl:'/admin/post/act',
			    search: '',
			    tbtitle:'Inventory Count List',
			    headers: 
			    [
			        {
			          	text: 'Name',
			          	align: 'left',
			          	sortable: true,
			          	value: 'title'
			        },
			        { text: 'Created At', value: 'created_at',align:'left' },
			        { text: 'Action',action:true, value: 'id',align:'left' }
			    ],
			    items:[],
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
		created(){
			this.fetchBlog(this.reqUrl);
		},
		methods:{
			fetchBlog(url){
				axios.get(url).then((res)=>{
					this.items=res.data
				}).catch((err) => {
	              	if(err.response.status === 422) {
	                  	console.log(err.response)
					}
					console.log('Error while saving data')
	          	})
			}
		}
	}
</script>