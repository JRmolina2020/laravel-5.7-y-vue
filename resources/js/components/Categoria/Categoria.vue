<template>
  <Header>
    <section slot="contenido">
      <Categoriaadd ref="Categoriaadd"></Categoriaadd>
      <Categorialist v-on:mostrar="mostrar"></Categorialist>
    </section>
  </Header>
</template>

<script>
import Header from "@/js/components/Header.vue";
import Categoriaadd from "@/js/components/Categoria/Categoriaadd.vue";
import Categorialist from "@/js/components/Categoria/Categorialist.vue";
export default {
  name: "Categoria",
  components: { Header, Categoriaadd, Categorialist },
  methods: {
    mostrar(item) {
      this.$refs.Categoriaadd.Mostrar(item);
    }
  }
};
</script>
