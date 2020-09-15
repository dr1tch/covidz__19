<template>
<div class="container-fluid" style="height: 100%">
    <Navbar></Navbar>
    <Sidebar></Sidebar>
    <router-view></router-view>
</div>
</template>

<script>
import Sidebar from './admin/templates/sidebar'
import Navbar from './admin/templates/navbar'
export default {
    data() {
        return {
            data: {
                user: '',
                role : '',
                auth: '',
                users: ''
            }
           
        }
    },
    components: {
        Sidebar,
        Navbar,
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
        },

    }
}
</script>
