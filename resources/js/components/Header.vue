<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-toolbar dark dense color="primary">
        <v-avatar>
          <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
        </v-avatar>
        <v-toolbar-title class="font-weight-thin">GMBYS</v-toolbar-title>
      </v-toolbar>
      <v-list>
        <v-list-tile v-for="item in items" :key="item.title" :to="item.link">
          <v-list-tile-action>
            <v-icon color="grey darken-1">{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar dark fixed app dense color="primary">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    </v-toolbar>
    <v-content>
      <v-container>
        <slot name="contenido"></slot>
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
      drawer: true,
      items: [
        { title: "Home", icon: "dashboard", link: "/" },
        { title: "Categoria", icon: "question_answer", link: "/categoria" },
        {
          title: "Producto",
          icon: "settings_input_composite",
          link: "/producto"
        }
      ],
      right: null
    };
  },
  props: {
    source: String
  }
};
</script>
