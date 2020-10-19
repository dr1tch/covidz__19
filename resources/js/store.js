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
      ideas: [],
      pubs: [],
      diseases: [],
      bookmarks: [],
      isBookmarked: '',
      isClicked: '',
      pubsBookmarks: '',
      isPubsBookmarked: '',
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
        wilayas: state => {
          return state.wilayas;
        },
        diseases: state => {
          return state.diseases;
        },
        jobs: state => {
          return state.jobs;
        },
        ideasBookmarks: state => {
          return state.bookmarks;
        },
        pubsBookmarks: state => {
          return state.pubsBookmarks;
        },
        isBookmarked: state => {
          return state.isBookmarked;
        },
        isPubBookmarked: state => {
          return state.isPubsBookmarked;
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
          state.pubsBookmarks = data.pubsBookmarks;
        },
        addGuest(state, data){
          console.log(data);
          state.categories = data.categories;
          state.wilayas = data.wilayas;
          state.jobs = data.jobs;
          state.diseases = data.diseases;
          state.ideas = data.ideas;
          state.pubs = data.pubs;
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
        pushPubsBookmark(state, data){
          let item = 0;
          state.pubsBookmarks.map((bookmark) => {
            if(bookmark.id == data.id){
              return item;
            } else {
              item++;
            }
          })
          console.log(item);
          if(item !== state.pubsBookmarks.length){
            state.pubsBookmarks.splice(item, 1);
          } else {
            state.pubsBookmarks.push(data);
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
        isBookedPubs: (state, data) => {
          let item = 0;
          state.pubsBookmarks.map((bookmark) => {
            if(bookmark.id == data.id){
              return item;
            } else {
              item++;
            }
          });
          console.log(item);
          if(item !== state.pubsBookmarks.length){
            state.isPubsBookmarked = true;
          } else {
            state.isPubsBookmarked = false;
          }
        },
        clicked: (state, pub) => {
          let item = 0;
          pub.users.map((i) => {
            if(i.id == state.user.id){
              return item;
            } else {
              item++;
            }
          });
          console.log(item);
          if(item !== pub.users.length){
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