<template>
  <v-app id="aspire">
	<nav-drawer :drawer="drawer" :items="items" :profiles="profiles"/>
	<page-content/>
  </v-app>
</template>
<script>
  import Flash from './helper/flash'
import NavDrawer from './components/layouts/NavDrawer'
import PageContent from './components/layouts/Content'
export default {
  name: 'App',
  components:{
	NavDrawer,PageContent
  },
  data(){
  	return{
  		drawer:null,
  		fullscreen:true,
      items: [
        { icon: 'dashboard', text: 'Dashboard',path:'/admin/dashboard' },
        { icon: 'monetization_on', text: 'Pricing',path:'/admin/pricing' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          preicon:'mode_edit',
          text: 'Post',
          model: false,
          children: [
            { icon: 'add',text: 'Write Post',path:'/admin/post/create' },
            { icon: 'remove_red_eye',text: 'Post List',path:'/admin/post/list' },
          ]
        }
      ],
      flash:Flash.state,
      profiles:[],
      username:'',
  	}
  },
  created(){
    Flash.setLoginName()
    this.username=this.flash.username
    console.log(this.flash.username)
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 0px;
}
</style>