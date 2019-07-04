<template>
  <div>
    <Header>
      <section slot="contenido">
        <Productoadd></Productoadd>
        <Productolist></Productolist>
      </section>
    </Header>
  </div>
</template>
<script>
import Header from "@/js/components/Header.vue";
import Productoadd from "@/js/components/Producto/Productoadd.vue";
import Productolist from "@/js/components/Producto/Productolist.vue";
export default {
  name: "Producto",
  components: { Header, Productoadd, Productolist }
};
</script>
