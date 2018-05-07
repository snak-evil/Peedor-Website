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
            <v-list-tile
              v-for="(child, i) in item.children"
              :key="i"
              @click=""
            >
              <v-list-tile-action v-if="child.icon">
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
				          <router-link :to="child.path">
                    {{ child.text }}
                  </router-link>
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <v-list-tile v-else @click="" :key="item.text">
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>
                <router-link :to="item.path">
                  {{ item.text }}
                </router-link>
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
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
      items: [
        { icon: 'dashboard', text: 'Dashboard',path:'/admin/dashboard' },
        // { icon: 'mode_edit', text: 'Post',path:'/admin/post/list' },
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
    }),
    props: [
      'profiles'
    ]
  }
</script>