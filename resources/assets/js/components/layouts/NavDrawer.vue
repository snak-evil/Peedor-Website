<template>
  <div>
    <v-navigation-drawer
      fixed
      :clipped="$vuetify.breakpoint.lgAndUp"
      app
      v-model="drawer" 
    >
      <v-list dense>
        <template v-for="item in items">
          <v-layout
            row
            v-if="item.heading"
            align-center
            :key="item.heading"
          >
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-flex>
            <v-flex xs6 class="text-xs-center">
              <a href="#!" class="body-2 black--text">EDIT</a>
            </v-flex>
          </v-layout>
          <v-list-group
            v-else-if="item.children"
            v-model="item.model"
            :key="item.text"
            :prepend-icon="item.preicon"
            :append-icon="item.model ? item.icon : item['icon-alt']"
          >
            <v-list-tile slot="activator">
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ item.text }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <router-link class="list__tile list__tile--link" v-for="(child, i) in item.children" :key="i" @click="" :to="child.path">
            <v-list-tile>
              <v-list-tile-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                    {{ child.text }}
                </v-list-tile-title>
              </v-list-tile-content>
           
            </v-list-tile>
          </router-link>
          </v-list-group>
        <router-link class="list__tile list__tile--link" v-else @click="" :key="item.text" :to="item.path">
          <v-list-tile style="margin-left:-20px !important;">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                  {{ item.text }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </router-link>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar
      color="blue-grey lighten-2"
      dark
      app
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <span class="hidden-sm-and-down">PEEDOR</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-menu offset-y>
        <v-btn slot="activator" icon large>
          <v-avatar size="32px" tile>
            <img
              src="/images/icon/PiiDoor-001-okay-01.png"
              alt="Peedor" style="border-radius: 50%;"
            >
          </v-avatar>
        </v-btn>
        <v-list>
          <v-list-tile v-for="(item,i) in profiles" @click="" :key="i">
            <v-list-tile-title>
              {{item}}
            </v-list-tile-title>
          </v-list-tile>
          <v-list-tile @click="">
            <v-list-tile-title onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>
  </div>
</template>

<script>
  export default {
    data: () => ({
      drawer: null,
    }),
    props: [
      'profiles',
      'items'
    ]
  }
</script>
<style type="text/css">
  div.menu__content{
    margin-left: -30px !important;
  }
</style>