<template>
  <v-app id="aspire">
	<nav-drawer :drawer="drawer"/>
	<page-content/>
  </v-app>
</template>
<script>
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
		fullscreen:true
	}
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