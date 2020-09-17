<template>
<div>
    <Sidebar v-if="admin"></Sidebar>
    <div class="container main-wall border-0">
        <Navbar v-if="admin"></Navbar>
        <router-view></router-view>
    </div>
    <!-- <admin v-if="admin"></admin>
    <user v-if="user"></user>
    <guest v-if="!auth"></guest> -->
</div>
</template>

<style scoped>
    /* .main-wall {
        border: none;
        max-width: 100%;
        margin-right:auto;
    } */
</style>


<script>
import Sidebar from './admin/templates/sidebar'
import Navbar from './admin/templates/navbar'
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
        Sidebar,
        Navbar,
        // admin,
        // user,
        // guest,
    },
    computed: {
        admin() {
            console.log('admin: ' + this.role === 'admin' && this.auth === true);
            return this.data.role === 'admin';
        },
        user() {
            console.log('User: ' + this.role === 'user' && this.auth === true);
            return this.data.role === 'user';
        },
        auth(){
            return this.data.auth;
        }
    },
    beforeMount() {
        axios.get('/admin/data')
            .then((response) => {
                console.log(response.data);
                this.data = response.data;
                this.$store.commit('addData', this.data);
                this.$store.commit('removeAdmin');
            });
    },
    mounted() {
        console.log('Component mounted.');
        axios.get('/admin/data')
            .then((response) => {
                console.log(response.data);
                this.data = response.data;
                this.$store.commit('addData', this.data);
            });

    },
    methods: {
        logout() {
            document.getElementById('logout').submit();
            axios.get('/admin/data')
                .then((response) => {
                    console.log(response.data);
                    this.data = response.data;
                    this.$store.commit('addData', this.data);
                });
        },

    }
}
</script>
