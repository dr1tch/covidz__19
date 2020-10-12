import Vue from 'vue';
import Vuex, { Store } from 'vuex';
Vue.use(Vuex);

import router from './router';

import axios from 'axios';
axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'X-CSRF-TOKEN': window.csrf_token
};

export default new Vuex.Store({
    state : {
      auth: false,
      role: '',
      users: [],
      user: [],
      categories: [],
      wilayas: [],
    },
    getters: {
        auth: state =>{
          return state.auth;
        },
        users: state =>{
          return state.users;
        }
        
    },

    mutations: {
        addData(state, data){
          state.auth = data.auth;
          state.role = data.role;
          state.users = data.users;
          state.user = data.user;
          state.categories = data.categories;
          state.wilayas = data.wilayas;
        },
        removeAdmin: (state) => {
          state.users.slice(3,1);
        },
        afterPagination : (state, users) => {
          state.users = users;
        }
    },

    actions :{
      asset(path) {
          let base_path = window.asset || '';
          console.log(base_path);
          return base_path + 'storage/' + path;
      },
    }
});