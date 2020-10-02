<template>
<div style="height: 100%;">
    <AdminSidebar v-if="admin"></AdminSidebar>
    <UserSidebar v-if="user"></UserSidebar>
    <div :class="mainWall()" style="height: 100%;">
        <Navbar v-if="admin" style="position: fixed; width: 50%;"></Navbar>
        <router-view></router-view>
    </div>
    <!-- <admin v-if="admin"></admin>
    <user v-if="user"></user>
    <guest v-if="!auth"></guest> -->
</div>
</template>

<style scoped>
    .welcome {
        border: none;
        width: 100%;
        margin-right:auto;
        margin-left: 0 !important;
    }
    .main-wall {
        border: none;
    }
    .admin {
        max-width: 100%;
        margin-right: auto;
    }
</style>


<script>

// Admin Templates:
import AdminSidebar from './admin/templates/sidebar'
import Navbar from './admin/templates/navbar'


// User Templates:
import UserSidebar from './user/templates/sidebar'

// import admin from './admin'
// import user from './user'
// import guest from './guest'
export default {
    data() {
        return {
            data: {
                user: '',
                role: '',
                auth: '',
                users: ''
            },

        }
    },
    components: {
        AdminSidebar,
        Navbar,
        UserSidebar
        // admin,
        // user,
        // guest,
    },
    computed: {
        admin() {
            // console.log('admin: ' + this.role === 'admin' && this.auth === true);
            return this.data.role === 'admin';
        },
        user() {
            // console.log('User: ' + this.role === 'user' && this.auth === true);
            return this.data.role === 'user';
        },
        auth(){
            return this.data.auth;
        },
        
    },
    beforeMount() {
        axios.get('/data')
            .then((response) => {
                // console.log(response.data);
                this.data = response.data;
                this.$store.commit('addData', this.data);
                this.$store.commit('removeAdmin');
            });
    },
    mounted() {
        console.log('Component mounted.');
        axios.get('/data')
            .then((response) => {
                // console.log(response.data);
                this.data = response.data;
                this.$store.commit('addData', this.data);
            });

    },
    methods: {
        adminClass() {
            // console.log('admin: ' + this.role === 'admin' && this.auth === true);
            return this.data.role === 'admin';
        },
        userClass() {
            // console.log('User: ' + this.role === 'user' && this.auth === true);
            return this.data.role === 'user';
        },
        authClass(){
            return this.data.auth;
        },
        mainWall(){
            if(this.authClass() && this.userClass()){
                return 'container-fluid main-wall';
            } else if(this.authClass() && this.adminClass()){
                return 'container-fluid main-wall admin';
            } else {
                return 'container-fluid welcome';
            }
        },
        logout() {
            document.getElementById('logout').submit();
            axios.get('/data')
                .then((response) => {
                    // console.log(response.data);
                    this.data = response.data;
                    this.$store.commit('addData', this.data);
                });
        },

    }
}
</script>
