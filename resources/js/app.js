import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import './bootstrap';
import Router from "./routes";
import Index from "./index";
import moment from "moment";
import SratRating from "./components/shared/components/StareRating";
import FatalError from "./components/shared/components/FatalError";
import ValidationErrors from "./components/shared/components/ValidationErrors";
import Success from "./components/shared/components/Success";
import storeDefinition from "./store";
window.Vue = require('vue').default;
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-2', require('./components/Example2.vue').default);
Vue.component("stare-rating", SratRating);
Vue.component("fatal-error", FatalError);
Vue.component("v-error", ValidationErrors);
Vue.component("success", Success);


Vue.filter("fromNow", value => moment(value).fromNow());
Vue.use(VueRouter);
Vue.use(Vuex);
/*const store = new Vuex.Store({

  });
  store.commit('increment');
  store.commit('changeName,"shakil"');
  console.log(store.state.count);*/

const store = new Vuex.Store(storeDefinition);

const app = new Vue({
    el: '#app',
    router: Router,
    store:store,
    components:{
        'index': Index
    },
     beforeCreate() {
        //loadStoredState
        this.$store.dispatch("loadStoredState");
     },
});
