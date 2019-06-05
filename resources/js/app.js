require('./bootstrap');
window.Vue = require('vue');
window.Vuetify = require('vuetify');
window.axios = require('axios');
window.Swal = require('sweetalert2');
import router from '@/js/routes.js'
import App from '@/js/views/App'
import store from './store';
import Vuelidate from 'vuelidate';
Vue.use(Vuetify);
Vue.use(Vuelidate);
Vue.component('Home', require('./components/Home.vue').default);
Vue.component('Spiner', require('./components/Spiner.vue').default);
Vue.component('Header', require('./components/Header.vue').default);
Vue.component('Categoria', require('./components/Categoria/Categoria.vue').default);
Vue.component('Producto', require('./components/Producto/Producto.vue').default);
const app = new Vue({
    el: '#app',
    store,
    router: router,
    render: h => h(App),
});

export default app;
