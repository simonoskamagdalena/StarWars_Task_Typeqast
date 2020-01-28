require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes'

//add it as plugin
Vue.use(VueRouter);

const app = new Vue({
        el: "#app",

        router: new VueRouter(routes)
    }
);