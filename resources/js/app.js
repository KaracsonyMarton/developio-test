require('./bootstrap');
window.Vue = require('vue').default;

import store from "./store";
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'

Vue.component('ticket-index', require('./components/Tickets/Index.vue').default);

Vue.use(VueGoodTablePlugin);

const app = new Vue({
    el: '#app',
    store,
});
