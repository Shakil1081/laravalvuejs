import Vue from 'vue';
import VueRouter from 'vue-router';
import './bootstrap';
import Router from "./routes";
import Index from "./index";
import moment from "moment";
import SratRating from "./components/shared/components/StareRating";
window.Vue = require('vue').default;
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-2', require('./components/Example2.vue').default);
Vue.component("stare-rating", SratRating);
Vue.filter("fromNow", value => moment(value).fromNow());
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router: Router,
    components:{
        'index': Index
    }
});
