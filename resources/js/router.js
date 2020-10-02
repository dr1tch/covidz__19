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
import Timeline from './components/user/Timeline';
import Profile from './components/user/Profile.vue';
import EditProfile from './components/user/EditProfile';


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
        { path: '/' , component: Welcome, name: 'Welcome'},
        { path: '/login', component: LoginPage, name: 'login' },
        { path: '/register', component: RegisterPage, name: 'register' },

        // USER ROUTES:
        { path: '/home' , component: Home, name: 'Home'},
        { path: '/ideas' , component: Timeline, name: 'Ideas'},
        { path: "/:username" , component: Profile, name: 'Profile'},
        { path: "/:username/edit" , component: EditProfile, name: 'EditProfile'},



        // ADMIN ROUTES:
        { path: '/admin/home' , component: adminHome, name: 'Admin-Home'},
        { path: '/admin/users' , component: adminUsers, name: 'Manage Users'},
        { path: '/admin/ideas' , component: adminIdeas, name: 'Manage Ideas'},

    ],
});


router.beforeEach((to, from, next) => {
        next();
});

export default router;