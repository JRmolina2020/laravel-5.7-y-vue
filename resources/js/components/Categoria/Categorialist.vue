<template>
  <div>
    <div v-if="loading">
      <Spiner></Spiner>
    </div>
    <v-layout v-else>
      <v-flex lg12>
        <template>
          <v-card>
            <v-card-title>
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Buscar categoria"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="categoria" :search="search">
              <template v-slot:items="props">
                <td class="text-xs-center">{{ props.item.nombre }}</td>
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
                  <v-btn @click="$emit('mostrar',props.item)" flat icon color="orange ">
                    <v-icon>border_color</v-icon>
                  </v-btn>
                  <v-btn @click="Eliminar(props.item)" flat icon color="red darken-3">
                    <v-icon>delete_forever</v-icon>
                  </v-btn>
                </td>
              </template>
              <template v-slot:no-results>
                <v-alert
                  :value="true"
                  color="error"
                  icon="warning"
                >Su búsqueda de la categoria "{{ search }}" No se encuentra en el registro.</v-alert>
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
  name: "Categorialist",
  components: { Spiner },
  data() {
    return {
      search: "",
      headers: [
        { text: "Nombre", value: "nombre", align: "center" },
        { text: "Estado", value: "condicion", align: "center" },
        { text: "Opciones", value: "Opciones", align: "center" }
      ]
    };
  },
  computed: {
    ...mapState(["categoria", "loading"])
  },
  mounted() {
    this.Listar();
  },
  methods: {
    Listar() {
      this.$store.dispatch("Listarcategoria");
    },
    Activar(item) {
      let url = "/Categoria/activar/" + item.id;
      axios.put(url).then(response => {
        this.Listar();
      });
    },
    Desactivar(item) {
      let url = "/Categoria/desactivar/" + item.id;
      axios.put(url).then(response => {
        this.Listar();
      });
    },
    Eliminar(item) {
      let url = "Categoria/" + item.id;
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
