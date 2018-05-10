<template>
  <v-app id="inspire">
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
                
                <v-tooltip right>
                  
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field prepend-icon="person" name="email" v-model="form.email" label="Email" id="email" type="text"></v-text-field>
                  <div class="input-group__details">
                    <div class="input-group__messages input-group__error" v-for="erremail in errors.email">{{erremail}}</div>
                  </div>
                  <v-text-field id="password" prepend-icon="lock" name="password" v-model="form.password" label="Password" type="password"></v-text-field>
                  <div class="input-group__details">
                    <div class="input-group__messages input-group__error" v-for="errpassword in errors.password">{{errpassword}}</div>
                  </div>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="login">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
  </v-app>
</template>

<script>

  export default {
    data(){
      return{
        drawer: null,
        form:{
          email:'',
          password:''
        },
        errors:{},
      }
     
    },
    props: {
      source: String
    },
    methods:{
      login(){
        axios.post('/login',this.form).then((res)=>{
            //if(res.data.auth==true){
              window.location.reload(true);
            //}
        }).catch((err) => {
          if(err.response.status === 422) {
            this.errors=err.response.data.errors
          }
          console.log('Error while saving data')
        })
      }
    }
  }
</script>