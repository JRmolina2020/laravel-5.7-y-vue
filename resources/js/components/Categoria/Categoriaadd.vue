<template>
  <div>
    <v-layout justify-space-between fill-height>
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
          <div class="text-xs-center">
            <v-btn dark v-on="on" @click="clear()" small color="primary">Nuevo</v-btn>
          </div>
        </template>
        <v-form @submit.prevent="Guardar(form.id)" autocomplete="off">
          <v-card>
            <v-card-title>
              <span class="headline">
                <h5 v-if="form.id" class="font-weight-thin.font-italic">Actualizar categoria</h5>
                <h5 v-else class="font-weight-thin.font-italic">Agregar Categoria</h5>
              </span>
              <!-- <h1>{{ form.id }}</h1> -->
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <!-- formulario categoria -->
                <v-text-field
                  v-model="form.nombre"
                  v-validate.continues="'required|max:10|min:4|alpha'"
                  :counter="10"
                  :error-messages="errors.collect('nombre')"
                  label="Name"
                  data-vv-name="nombre"
                  required
                ></v-text-field>

                <!-- end formulario categoria -->
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                :disabled="!formValidated"
                class="btn btn-primary"
                data-dismiss="modal"
                type="submit"
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
      if (id == null) {
        let url = "Categoria";
        axios
          .post(url, {
            nombre: this.form.nombre
          })
          .then(response => {
            this.$store.dispatch("Listarcategoria");
            this.clear();
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
      this.$validator.validateAll();
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
