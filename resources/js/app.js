import App from './components/App.vue';
import router from './router.js';
import store from './store';
import common from './common'
import Vue from 'vue';
import "core-js/fn/object/assign";

import VModal from 'vue-js-modal'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSpinner } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

require('./bootstrap');
window.Vue = require('vue');
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
Vue.use(VModal);
library.add(faSpinner)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.mixin(common);



const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    store
});
