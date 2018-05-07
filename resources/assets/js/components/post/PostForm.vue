<template id="{{ $route.params.id }}">
  <div id="app">
  	<simple-breadcrumb :breadcrumbs="breadcrumbs"/>
    <single-form 
	:forms-control="formsControl"
	:data="data"
	:title="'Write Post'"
	:reqUrl="reqUrl"
	:id="id"/>
  </div>
</template>
<script>
  import singleForm from '../forms/singleForm'
  import simpleBreadcrumb from '../breadcrumbs/simpleBreadcrumb'
  export default {
	props:[
		'id'
	],
	components:{
		
		singleForm,
		simpleBreadcrumb
	},
	
    data() {
    
	return {
		reqUrl:'/post/',
		formsControl:[
		
			{size:'xs12 sm3 md3',text:'Title',type:'textbox',rule:true,name:'title'},
			{size:'xs12 sm12 md12',text:'Body',type:'editor',rule:true,name:'body'},
		],
		data:{},
		breadcrumbs:[
	      {
	        text: 'Post',
	        disabled: false
	      },
	      {
	        text: 'Edit',
	        disabled: false
	      }
	    ]
      }
    },
    created(){
    	this.getData(this.id);
    },
    methods:{
    	getData(id){
    		axios.get(this.reqUrl+id+'/edit').then((res)=>{
    			this.data=res.data
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