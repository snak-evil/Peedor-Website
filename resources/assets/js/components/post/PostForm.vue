<template id="{{ $route.params.id }}">
  <div id="app">
  	<simple-breadcrumb :breadcrumbs="breadcrumbs"/>
    <group-form
	:form-groups="groups"
	:data="data"
	:title="'Write Post'"
	:reqUrl="reqUrl"
	:id="id"/>
  </div>
</template>
<script>
  import groupForm from '../forms/groupForm'
  import simpleBreadcrumb from '../breadcrumbs/simpleBreadcrumb'
  export default {
	props:[
		'id'
	],
	components:{
		
		groupForm,
		simpleBreadcrumb
	},
	
    data() {
    
	return {
		reqUrl:'/post/',
		groups:[
			{
				item:'Basic Information',size:'xs12 sm8 md8', formsControl:[
			
					{size:'xs12 sm12 md12',text:'Title',type:'textbox',rule:true,name:'title'},
					{size:'xs12 sm12 md12',text:'Belong To Menu',type:'select',rule:true,name:'menu_id',items:'menus'},
				]
			},
			{
				item:'Image',size:'xs12 sm4 md4',formsControl:[
					{size:'xs12 sm12 md12',text:'Image',type:'image',rule:true,name:'image'},
				]
			},
			{
				item:'Paragraph',size:'xs12 sm1 md12',formsControl:[
					{size:'xs12 sm12 md12',text:'Body',type:'editor',rule:true,name:'body'},
				]
			},
		],
		data:{
			image:'',
			menu_id:1,
			menus:[],
		},
		
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
    			if(id>0){
    				this.data=res.data.post	
    			}
    			
    			this.data.menus=res.data.menus
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