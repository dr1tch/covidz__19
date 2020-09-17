import Vue from 'vue';
import axios from 'axios';
import store from './store';

// Routes imports:

// Guest Routes
import LoginPage from './components/LoginPage';
import RegisterPage from './components/RegisterPage';
import Welcome from './components/Welcome';

// User Auth Routes
import Home from './components/user/pages/Home';
import Ideas from './components/user/Ideas';

// Admin Routes
import adminHome from './components/admin/Home'
import adminUsers from './components/admin/Users'
import adminIdeas from './components/admin/Ideas'


import VueRouter from 'vue-router';
Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        // GUEST ROUTES:
        { path: '/' , component: Welcome, name: 'welcome'},
        { path: '/login', component: LoginPage, name: 'login' },
        { path: '/register', component: RegisterPage, name: 'register' },

        // USER ROUTES:
        { path: '/home' , component: Home, name: 'home'},
        { path: '/ideas' , component: Ideas, name: 'ideas'},



        // ADMIN ROUTES:
        { path: '/admin/home' , component: adminHome, name: 'admin-home'},
        { path: '/admin/users' , component: adminUsers, name: 'admin-users'},
        { path: '/admin/ideas' , component: adminIdeas, name: 'admin-ideas'},

    ],
});


router.beforeEach((to, from, next) => {
        next();
});

export default router;