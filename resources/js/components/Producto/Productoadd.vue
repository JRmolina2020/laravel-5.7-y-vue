<template>
  <div>
    <v-layout align-center justify-center row>
      <v-dialog v-model="dialog" persistent max-width="800px">
        <template v-slot:activator="{ on }">
          <div class="text-xs-center">
            <v-btn dark v-on="on" @click="clear()" small color="primary">Nuevo</v-btn>
          </div>
        </template>
        <v-form @submit.prevent="Guardar(form.id)" autocomplete="off">
          <v-card>
            <v-toolbar card color="primary" dense dark>
              <h3>Registrar Productos</h3>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text>
              <v-container grid-list-md>
                <!-- formulario producto -->
                <v-layout>
                  <v-flex lg4 md6 xs12 sm12>categoria</v-flex>
                  <v-flex lg4 md6 xs12 sm12>
                    <v-text-field
                      v-model="form.codigo"
                      v-validate="'required|digits:3|min_value:1'"
                      :counter="3"
                      :error-messages="errors.collect('codigo')"
                      label="Codigo del producto"
                      data-vv-name="codigo"
                    ></v-text-field>
                  </v-flex>
                  <v-flex lg4 md5 xs12 sm12>
                    <v-text-field
                      v-model="form.nombre"
                      v-validate="'required|max:15|min:4|'"
                      :counter="15"
                      :error-messages="errors.collect('nombre')"
                      label="Nombre del producto"
                      data-vv-name="nombre"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout>
                  <v-flex lg4 md6 xs12 sm12>
                    <v-text-field
                      v-model="form.precio_venta"
                      v-validate="'required|max:9|min:3|numeric'"
                      data-vv-as="field"
                      :error-messages="errors.collect('precio_venta')"
                      :counter="9"
                      prefix="$"
                      label="Precio de venta"
                      data-vv-name="precio_venta"
                    ></v-text-field>
                  </v-flex>
                  <v-flex lg4 md6 xs12 sm12>
                    <v-text-field
                      v-model="form.stock"
                      v-validate="'required|max:4|min:1|numeric'"
                      type="text"
                      :error-messages="errors.collect('stock')"
                      label="Stock"
                      data-vv-name="stock"
                    ></v-text-field>
                  </v-flex>
                  <v-flex lg4 md6 xs12 sm12>
                    <v-textarea
                      v-model="form.descripcion"
                      v-validate.continues="'required|max:60|min:10|'"
                      :counter="60"
                      :error-messages="errors.collect('descripcion')"
                      label="Descripcion"
                      rows="1"
                      data-vv-name="descripcion"
                      color="teal"
                    ></v-textarea>
                  </v-flex>
                </v-layout>
                <v-layout>
                  <v-flex lg12 md12 xs12 sm12>imagen</v-flex>
                </v-layout>

                <!-- end formulario producto -->
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
        id: null,
        categoria_id: null,
        codigo: null,
        nombre: "",
        precio_venta: null,
        stock: 0,
        descripcion: "",
        imagen: null
      }
    };
  },

  methods: {
    //Guardar categoria
    Guardar(id) {
      this.$validator.validate().then(valid => {
        if (valid) {
          alert("bien");
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
