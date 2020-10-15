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
      jobs: [],
      diseases: [],
      bookmarks: [],
      isBookmarked: '',
      isClicked: '',
    },
    getters: {
        auth: state =>{
          return state.auth;
        },
        users: state =>{
          return state.users;
        },
        user: state => {
          return state.user;
        },
        isBookmarked: state => {
          return state.isBookmarked;
        },
        isLiked: state => {
          return state.isClicked;
        }
    },

    mutations: {
        addData(state, data){
          console.log(data);
          state.auth = data.auth;
          state.role = data.role;
          state.users = data.users;
          state.user = data.user;
          state.categories = data.categories;
          state.wilayas = data.wilayas;
          state.jobs = data.jobs;
          state.diseases = data.diseases;
          state.bookmarks = data.bookmarks;
        },
        pushBookmark(state, data){
          let item = 0;
          state.bookmarks.map((bookmark) => {
            if(bookmark.id == data.id){
              return item;
            } else {
              item++;
            }
          })
          console.log(item);
          if(item !== state.bookmarks.length){
            state.bookmarks.splice(item, 1);
          } else {
            state.bookmarks.push(data);
          }
        },
        isBooked: (state, data) => {
          let item = 0;
          state.bookmarks.map((bookmark) => {
            if(bookmark.id == data.id){
              return item;
            } else {
              item++;
            }
          });
          console.log(item);
          if(item !== state.bookmarks.length){
            state.isBookmarked = true;
          } else {
            state.isBookmarked = false;
          }
        },
        clicked: (state, idea) => {
          let item = 0;
          idea.users.map((i) => {
            if(i.id == state.user.id){
              return item;
            } else {
              item++;
            }
          });
          console.log(item);
          if(item !== idea.users.length){
            state.isClicked = true;
          } else {
            state.isClicked = false;
          }
          // console.log(state.isClicked);
        },
    },

    actions :{
      asset(path) {
          let base_path = window.asset || '';
          console.log(base_path);
          return base_path + 'storage/' + path;
      },
    }
});