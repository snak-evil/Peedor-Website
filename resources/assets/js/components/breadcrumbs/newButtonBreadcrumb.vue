<template>
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
    <v-btn color="primary" @click="createForm(url)">Add New</v-btn>
  </v-toolbar>
</template>
<script>
	export default{

		props:[
			'breadcrumbs',
      'url'
		],
    methods:{
      createForm(url){
        this.$router.push(url)
      }
    }

	}
</script>