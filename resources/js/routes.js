import Vue from "vue";
import Vuerouter from "vue-router";
import Home from "@/js/components/Home.vue";
import Categoria from "@/js/components/Categoria/Categoria.vue";
import Producto from "@/js/components/Producto/Producto.vue";


Vue.use(Vuerouter);

const router = new Vuerouter({
    mode: 'history',
    routes: [{
        path: '/',
        name: 'home',
        component: Home

    },
    {
        path: '/categoria',
        name: 'categoria',
        component: Categoria

    },
    {
        path: '/producto',
        name: 'producto',
        component: Producto

    },
    ]
});
export default router;
