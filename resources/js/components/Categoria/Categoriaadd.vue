<template>
  <div>
    <v-layout align-center justify-center row>
      <v-dialog v-model="dialog" persistent max-width="350px">
        <template v-slot:activator="{ on }">
          <v-btn fab bottom right color="red darken-2" dark fixed v-on="on" @click="clear()">
            <v-icon>add</v-icon>
          </v-btn>
        </template>
        <v-form @submit.prevent="Guardar(form.id)" autocomplete="off">
          <v-card>
            <v-toolbar card class="info" :class="{'warning':form.id}" dense dark>
              <h3 v-if="form.id">Editar categoria</h3>
              <h3 v-else>Guardar categoria</h3>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-container grid-list-md>
                <!-- formulario categoria -->
                <v-text-field
                  v-model="form.nombre"
                  v-validate="'required|max:15|min:4|alpha_spaces'"
                  :counter="15"
                  :error-messages="errors.collect('nombre')"
                  label="Nombre de la categoria"
                  placeholder="Nombre"
                  data-vv-name="nombre"
                ></v-text-field>
                <!-- end formulario categoria -->
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                :disabled="errors.any()"
                class="btn btn-primary"
                data-dismiss="modal"
                type="submit"
                color="primary"
              >
                <h5 v-if="form.id">Editar</h5>
                <h5 v-else>Guardar</h5>
              </v-btn>

              <v-btn round color="error" lat @click="clear()">
                <h5>SALIR</h5>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
    </v-layout>
  </div>
</template>
<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  computed: {
    formValidated() {
      return (
        Object.keys(this.fields).some(key => this.fields[key].validated) &&
        Object.keys(this.fields).some(key => this.fields[key].valid)
      );
    }
  },

  data() {
    return {
      dialog: false,
      form: {
        nombre: "",
        id: null
      }
    };
  },

  methods: {
    //Guardar categoria
    Guardar(id) {
      this.$validator.validate().then(valid => {
        if (valid) {
          if (id == null) {
            let url = "Categoria";
            axios
              .post(url, {
                nombre: this.form.nombre
              })
              .then(response => {
                this.$store.dispatch("Listarcategoria");
                this.clear();
                this.save = true;
              })
              .catch(error => {
                this.errors = error.response.data;
              });
          } else {
            //Editar categoria
            let url = "Categoria/" + id;
            axios.put(url, this.form).then(response => {
              this.clear();
              this.$store.dispatch("Listarcategoria");
              Swal.fire("Editar!", "Editado con exito!", "success");
            });
          }
        }
      });
    },
    Mostrar(item) {
      this.dialog = true;
      this.form.id = item.id;
      this.form.nombre = item.nombre;
    },
    clear() {
      this.form.nombre = "";
      this.form.id = null;
      this.dialog = false;
      this.$validator.reset();
    }
  }
};
</script>
