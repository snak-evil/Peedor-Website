
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import VueEditor from 'vue2-quill-editor'
import Vuetify from 'vuetify'
require('./bootstrap');
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
Vue.use(Vuetify)
Vue.use(VueResource)
Vue.use(VueRouter)
// Vue.use(Axios)
Vue.use(VueEditor)

Vue.http.options.credentials = true;

Vue.http.options.xhr = {
  withCredentials: true
}
Vue.http.options.emulateJSON = true
Vue.http.options.emulateHTTP = true
Vue.http.options.crossOrigin = true

Vue.http.headers.common['Access-Control-Allow-Origin'] = 'http://localhost:9200'
Vue.http.headers.common['Access-Control-Request-Method'] = '*'
Vue.http.headers.common['Content-Type'] = 'application/x-www-form-urlencoded'
Vue.http.headers.common['Accept'] = 'application/json, text/plain, */*'
Vue.http.headers.common['Access-Control-Allow-Headers'] = 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin'
import App from './App.vue'
import LoginApp from './LoginApp.vue'
import Home from './components/home'
import PageNotFound from './components/layouts/PageNotFound'
import Post from './components/post/Post'
import PostList from './components/post/PostList'
import PostForm from './components/post/PostForm'

const router = new VueRouter({
  	mode: 'history',
  	routes: [
  		{ path: '/admin', name:'fhome',component: Home },
  		{
  			path:'/admin/post',name:'Post',component:Post,
  			children:[
  				{ path:'list',name:'PostList',component:PostList },
  				{ path:'create',name:'PostCreate',component:PostForm },
  				{ path:'act/:id',name:'PostForm',component:PostForm,props:true }
  			]
  		},
      {path:'/login',name:'login',component:LoginApp},
  		{path:'/admin/*',name:'404NotFound',component:PageNotFound}
  	]
})

const app = new Vue({
	// el: '#root',
	router,
	template: `
	<app></app>
	`,
	components: { App },
}).$mount('#app')

//if(this.$route.page=='login'){
  const login_app = new Vue({
    // el: '#root',
    router,
    template: `
    <login-app></login-app>
    `,
    components: { LoginApp },
  }).$mount('#login-app')
//}
