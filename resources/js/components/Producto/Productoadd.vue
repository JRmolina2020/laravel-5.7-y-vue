<template>
  <div>
    <v-layout align-center justify-center row>
      <v-dialog v-model="dialog" persistent max-width="800px">
        <template v-slot:activator="{ on }">
          <v-btn fab bottom right color="red darken-2" dark fixed v-on="on" @click="clear()">
            <v-icon>add</v-icon>
          </v-btn>
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
                  <v-flex lg4 md6 xs12 sm12>
                    <v-select
                      :items="CategoriaSelect"
                      item-text="nombre"
                      v-validate="'required|'"
                      item-value="id"
                      label="Categoria del producto"
                      :error-messages="errors.collect('categoria')"
                      data-vv-name="categoria"
                      v-model="form.categoria_id"
                    ></v-select>
                  </v-flex>
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
                      
                      :error-messages="errors.collect('precio')"
                      :counter="9"
                      prefix="$"
                      label="Precio de venta"
                      data-vv-name="precio"
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
      save: false,
      CategoriaSelect: [],
      form: {
        id: null,
        categoria_id: "",
        codigo: null,
        nombre: "",
        precio_venta: null,
        stock: null,
        descripcion: "",
        imagen: "https://www.dimm.com.uy/imgs/productos/productos35_30764.jpg"
      }
    };
  },
  created() {
    this.LlenaSelectcategoria();
  },
  methods: {
    //Guardar categoria
    Guardar(id) {
      this.$validator.validate().then(valid => {
        if (valid) {
          if (id == null) {
            let url = "Producto";
            axios
              .post(url, {
                categoria_id: this.form.categoria_id,
                codigo: this.form.codigo,
                nombre: this.form.nombre,
                precio_venta: this.form.precio_venta,
                stock: this.form.stock,
                descripcion: this.form.descripcion,
                imagen: this.form.imagen
              })
              .then(response => {
                this.$store.dispatch("Listarproducto");
                this.clear();
              })
              .catch(error => {
                console.log(error);
              });
          } else {
            let url = "Producto/" + id;
            axios.put(url, this.form).then(response => {
              this.clear();
              this.$store.dispatch("Listarproducto");
              Swal.fire("Editar!", "Editado con exito!", "success");
            });
          }
        }
      });
    },
    Mostrar(item) {
      this.dialog = true;
      this.form.id = item.id;
      this.form.categoria_id = item.categoria_id;
      this.form.nombre = item.nombre;
      this.form.codigo = item.codigo;
      this.form.precio_venta = item.precio_venta;
      this.form.stock = item.stock;
      this.form.descripcion = item.descripcion;
    },
    LlenaSelectcategoria() {
      axios
        .get("Categoria/selectcategoria")
        .then(response => {
          this.CategoriaSelect = response.data.categorias;
        })
        .catch(e => {
          console.log(e);
        });
    },
    clear() {
      this.form.nombre = null;
      this.form.id = null;
      this.form.codigo = null;
      this.form.nombre = null;
      this.form.precio_venta = null;
      this.form.stock = null;
      this.form.descripcion = null;
      this.dialog = false;
      this.$validator.reset();
    }
  }
};
</script>
