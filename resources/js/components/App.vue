<template>
<div style="height: 100%;">
    <AdminSidebar v-if="admin"></AdminSidebar>
    <UserSidebar v-if="user" :categories="categoriess" :wilayas="wilayass"></UserSidebar>
    <div :class="mainWall()" style="height: 100%;">
        <Navbar v-if="admin"></Navbar>
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
    <!-- <UserRightbar v-if="$route.name === 'Publications'"></UserRightbar> -->
    <!-- <admin v-if="admin"></admin>
    <user v-if="user"></user>
    <guest v-if="!auth"></guest> -->
</div>
</template>

<style scoped>
.welcome {
    border: none;
    width: 100%;
    margin-right: auto;
    margin-left: 0 !important;
}

.main-wall {
    border: none;
}

.admin {
    max-width: 100%;
    margin-right: auto;
}
/* .pub {
    max-width: 100% !important;
    margin-right: 0 !important;
} */
</style>

<script>
// Admin Templates:
import AdminSidebar from './admin/templates/sidebar'
import Navbar from './admin/templates/navbar'

// User Templates:
import UserSidebar from './user/templates/sidebar'
import UserRightbar from './user/templates/rightbar'

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
                users: '',
                categories: '',
                wilayas: '',
                diseases: '',
                jobs: '',
                bookmarks: '',
                pubsBookmarks: ''
            },
            guest: {
                auth: '',
                categories: '',
                wilayas: '',
                diseases: '',
                jobs: '',
            }

        }
    },
    components: {
        AdminSidebar,
        Navbar,
        UserSidebar,
        UserRightbar,
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
        auth() {
            return this.data.auth;
        },
        categoriess() {
            return this.categories;
        },
        wilayass() {
            return this.wilayas;
        }
    },
    beforeMount() {
        this.$Progress.start();
        axios.get('/data')
            .then((response) => {
                // console.log(response);
                this.data = response.data;

                this.$store.commit('addData', this.data);
            });
    },
    mounted() {
        console.log('Component mounted.');
        
        axios.get('/data')
            .then((response) => {
                // console.log(response.data);
                this.data = response.data;
                this.$store.commit('addData', this.data);
            }).catch((errors) => {
                console.log(errors);
                this.$Progress.fail();
            });
        this.$Progress.finish();
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
        authClass() {
            return this.data.auth;
        },
        mainWall() {
            if (this.authClass() && this.userClass()) {
                if(this.$route.name == "Publications"){
                    return 'container-fluid main-wall pub'
                } else {
                    return 'container-fluid main-wall';
                }
            } else if (this.authClass() && this.adminClass()) {
                return 'container-fluid main-wall admin';
            } else if(this.$route.name == 'Welcome' || this.$route.name == 'login' || this.$route.name == 'register') {
                return 'container-fluid welcome';
            } else if(!this.$store.state.auth){
                return 'container-fluid main-wall';
            } else {
                return 'container-fluid main-wall';
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
