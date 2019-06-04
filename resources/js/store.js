import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        item: [],
        loading: true,
        urlcategoria: 'Categoria/'
    },
    mutations: {
        LIST(state, item) {
            state.item = item;
        },
    },
    actions: {
        Listarcategoria({
            commit,
            state
        }) {
            axios.get(state.urlcategoria)
                .then(res => {
                    commit('LIST', res.data)
                    state.loading = false
                }).catch(err => {
                    console.log(err)
                })
        },
    }
})
