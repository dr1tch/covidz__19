import App from './components/App.vue';
import router from './router.js';
import store from './store';
import common from './common'
import Vue from 'vue';
import "core-js/fn/object/assign";
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import VModal from 'vue-js-modal'
import VueProgressBar from "vue-progressbar";

// import 'vue-progress-path/dist/vue-progress-path.css'
// import VueProgress from 'vue-progress-path'
// import { library } from '@fortawesome/fontawesome-svg-core'
// import { fas } from '@fortawesome/free-solid-svg-icons'
// library.add(fas)
// import { far } from '@fortawesome/free-solid-svg-icons'
// library.add(far)

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import moment from 'moment';
Vue.prototype.moment = moment;
require('./bootstrap');
window.Vue = require('vue');
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
};
Vue.use(VModal);
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.mixin(common);

Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    // failedColor: "red",
    // height: "2px"
    // color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    //   location: 'left',
    inverse: false
});


const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    store
});
