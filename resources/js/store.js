import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        item: [],
        producto: [],
        loading: true,
        urlcategoria: 'Categoria/',
        urlproducto: 'Producto/',
    },
    mutations: {
        LIST(state, item) {
            state.item = item;
        },
        LISTPRODUCTO(state, producto) {
            state.producto = producto;
        },
    },
    actions: {
        Listarcategoria({ commit, state }) {
            axios
                .get(state.urlcategoria)
                .then(res => {
                    commit('LIST', res.data);
                    state.loading = false;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        Listarproducto({ commit, state }) {
            axios
                .get(state.urlproducto)
                .then(res => {
                    commit('LISTPRODUCTO', res.data);
                    state.loading = false;
                })
                .catch(err => {
                    console.log(err);
                });
        },
    },
});