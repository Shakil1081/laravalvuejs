import Vue from 'vue';
import VueRouter from 'vue-router';
import './bootstrap';
import router from "./routes";
import Index from "./index";


window.Vue = require('vue').default;
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-2', require('./components/Example2.vue').default);

Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router,
    components:{
        'index': Index
    }
});
