import Vuex from 'vuex';
import Vue from 'vue';
import tickets from './modules/tickets';

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
    modules: {
        tickets,
    }
});
