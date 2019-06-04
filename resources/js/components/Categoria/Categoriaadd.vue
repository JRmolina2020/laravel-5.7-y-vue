<template>
  <div>
    <v-layout justify-space-between fill-height>
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
          <div class="text-xs-center">
            <v-btn round color="primary" dark v-on="on" @click="clear()">Nuevo</v-btn>
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
                  :error-messages="nombreErrors"
                  :counter="10"
                  label="Categoria"
                  required
                  @input="$v.form.nombre.$touch()"
                  @blur="$v.form.nombre.$touch()"
                ></v-text-field>
                <!-- end formulario categoria -->
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn type="submit" round color="primary" :disabled="$v.$invalid">
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
import { validationMixin } from "vuelidate";
import { required, maxLength, minLength } from "vuelidate/lib/validators";
export default {
  validations: {
    form: {
      nombre: { required, maxLength: maxLength(10), minLength: minLength(4) }
    }
  },
  data() {
    return {
      errors: [],
      dialog: false,
      form: {
        nombre: "",
        id: null
      }
    };
  },
  computed: {
    nombreErrors() {
      const errors = [];
      if (!this.$v.form.nombre.$dirty) return errors;
      !this.$v.form.nombre.maxLength &&
        errors.push("El campo nombre debe contener maximo 10 caracteres.");
      !this.$v.form.nombre.required &&
        errors.push("El campo nombre es requerido.");
      !this.$v.form.nombre.minLength &&
        errors.push("El campo nombre debe contener minimo 4 caracteres.");
      return errors;
    }
  },
  methods: {
    //Guardar categoria
    Guardar(id) {
      if (id == null) {
        if (!this.$v.$invalid) {
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
          console.log("❌ Invalid form");
        }
      } else {
        //Editar categoria
        let url = "Categoria/" + id;
        axios.put(url, this.form).then(response => {
          this.clear();
          this.$store.dispatch("Listarcategoria");
          Swal.fire("Editar!", "Editado con exito!", "success");
        });
      }
    },
    Mostrar(item) {
      this.dialog = true;
      this.form.id = item.id;
      this.form.nombre = item.nombre;
    },
    clear() {
      this.$v.form.$reset();
      this.form.nombre = "";
      this.form.id = null;
      this.dialog = false;
    }
  }
};
</script>
