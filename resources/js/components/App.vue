<template>
<div style="height: 100%;">
    <AdminSidebar v-if="admin"></AdminSidebar>
    <UserSidebar v-if="user"></UserSidebar>
    <div :class="[auth ? 'container-fluid main-wall' : 'container-fluid welcome']" style="height: 100%;">
        <Navbar v-if="admin"></Navbar>
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
        }
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
