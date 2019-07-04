<template>
  <div>
    <div v-if="loading">
      <Spiner></Spiner>
    </div>
    <v-layout v-else align-center justify-center row>
      <v-flex lg12>
        <template>
          <v-card>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Buscar producto"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="producto" :search="search">
              <template v-slot:items="props">
                <td class="text-xs-center">{{ props.item.codigo }}</td>
                <td class="text-xs-center">{{ props.item.nombre }}</td>
                <td class="text-xs-center">{{ props.item.precio_venta }}</td>
                <td class="text-xs-center">
                  <v-badge center>
                    <template v-slot:badge>
                      <span>{{ props.item.stock }}</span>
                    </template>
                    <v-icon
                      v-if="props.item.stock>0 && props.item.stock <=4"
                      color="orange lighten-1"
                    >shopping_cart</v-icon>
                    <v-icon
                      v-else-if="props.item.stock>=5"
                      color="green darken-1"
                    >remove_shopping_cart</v-icon>
                    <v-icon v-else color="red">remove_shopping_cart</v-icon>
                  </v-badge>
                </td>
                <td class="text-xs-center">{{ props.item.descripcion }}</td>
                <td>
                  <v-img :src="props.item.imagen">
                    <template v-slot:placeholder>
                      <v-layout fill-height align-center justify-center ma-0>
                        <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                      </v-layout>
                    </template>
                  </v-img>
                </td>
                <td class="text-xs-center">
                  <v-btn
                    v-if="props.item.condicion==1"
                    flat
                    icon
                    color="#00c853"
                    @click="Desactivar(props.item)"
                  >
                    <v-icon>toggle_on</v-icon>
                  </v-btn>
                  <v-btn v-else flat icon color="#c30000" @click="Activar(props.item)">
                    <v-icon>toggle_off</v-icon>
                  </v-btn>
                </td>
                <td class="text-xs-center">
                  <v-icon small class="mr-2" @click="$emit('mostrar',props.item)">edit</v-icon>
                  <v-icon small @click="Eliminar(props.item)">delete</v-icon>
                </td>
              </template>
              <template v-slot:no-results>
                <v-alert
                  :value="true"
                  color="error"
                  icon="warning"
                >El producto "{{ search }}" No se encuentra en el registro.</v-alert>
              </template>
            </v-data-table>
          </v-card>
        </template>
      </v-flex>
    </v-layout>
  </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
import Spiner from "@/js/components/Spiner.vue";
export default {
  name: "Productolist",
  components: { Spiner },
  data() {
    return {
      search: "",
      headers: [
        { text: "Codigo", value: "codigo", align: "center" },
        { text: "Nombre", value: "nombre", align: "center" },
        { text: "Precio", value: "precio_venta", align: "center" },
        { text: "Stock", value: "stock", align: "center" },
        { text: "Descripcion", value: "descripcion", align: "center" },
        { text: "Imagen", value: "imagen", align: "center" },
        { text: "Estado", value: "condicion", align: "center" },
        { text: "Opciones", value: "Opciones", align: "center" }
      ]
    };
  },
  computed: {
    ...mapState(["producto", "loading"])
  },
  mounted() {
    this.Listar();
  },
  methods: {
    Listar() {
      this.$store.dispatch("Listarproducto");
    },
    Activar(item) {
      let url = "/Producto/activar/" + item.id;
      axios.put(url).then(response => {
        this.Listar();
      });
    },
    Desactivar(item) {
      let url = "/Producto/desactivar/" + item.id;
      axios.put(url).then(response => {
        this.Listar();
      });
    },
    Eliminar(item) {
      let url = "Producto/" + item.id;
      Swal.fire({
        title: "Esta seguro?",
        text: "Una vez eliminado el registro no se podra recuperar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(result => {
        if (result.value) {
          axios
            .delete(url)
            .then(response => {
              Swal.fire("Eliminado!", "Transaccion exitosa.", "success");
              this.Listar();
            })
            .catch(err => {
              Swal.fire("No se puede eliminar!", "success");
            });
        }
      });
    }
  }
};
</script>
