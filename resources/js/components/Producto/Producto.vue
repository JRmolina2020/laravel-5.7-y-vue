<template>
  <div>
    <Header>
      <section slot="contenido">
        <Productolist></Productolist>
      </section>
    </Header>
  </div>
</template>
<script>
import Header from "@/js/components/Header.vue";
import Productolist from "@/js/components/Producto/Productolist.vue";
export default {
  name: "Producto",
  components: { Header, Productolist }
};
</script>
