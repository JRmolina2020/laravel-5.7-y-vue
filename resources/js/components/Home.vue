<template>
  <div>
    <Header>
      <section slot="contenido">HOME</section>
    </Header>
  </div>
</template>
<script>
import Header from "@/js/components/Header.vue";
export default {
  name: "Home",
  components: { Header },
  data() {
    return {};
  }
};
</script>
