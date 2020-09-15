import App from './components/App.vue';
import router from './router.js';
import store from './store';
import Vue from 'vue';
import "core-js/fn/object/assign";
require('./bootstrap');


window.Vue = require('vue');





const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    store
});
