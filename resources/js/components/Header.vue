<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" fixed app>
      <v-list dense>
        <v-list-tile v-for="item in items" :key="item.title" :to="item.link">
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>GamersBy</v-toolbar-title>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center>
          <slot name="contenido"></slot>
        </v-layout>
      </v-container>
    </v-content>
    <!-- <v-footer color="indigo" app>
      <span class="white--text">&copy; 2017</span>
    </v-footer>-->
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: false,
      items: [
        { title: "Home", icon: "dashboard", link: "/" },
        { title: "Categoria", icon: "question_answer", link: "/categoria" }
      ],
      right: null
    };
  },
  props: {
    source: String
  }
};
</script>
