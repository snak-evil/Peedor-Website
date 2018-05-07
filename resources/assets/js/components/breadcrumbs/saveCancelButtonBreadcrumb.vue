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
    <v-toolbar-items>
      <v-btn color="primary" :disabled="!valid" @click.prevent="submit(url)">Save</v-btn>
      &nbsp;
      <v-btn color="primary" @click="cancel(url)">Cancel</v-btn>
    </v-toolbar-items>
  </v-toolbar>
</template>
<script>
	export default{

		props:[
			'breadcrumbs',
      'url',
      'valid'
		],
    methods:{
      submit(){
        alert('submit')
      },
      cancel(url){
        this.$router.push(url)
      }
    }

	}
</script>