<template lang="">
<div>
    <!-- <div class='flex justify-content-center align-items-center alert alert-success width-auto'>
        Hello,
        Welcome Boss!
    </div> -->
    
                    <Navbar></Navbar>
                     <Sidebar></Sidebar>
                    </div>
                   
</template>

<script>
import Sidebar from './templates/sidebar'
import Navbar from './templates/navbar'

export default {
     data() {
            return {
                csrf_token: window.csrf_token
            }
        },
        components: {
            Sidebar, Navbar,
        },
        methods: {
            logout() {
                document.getElementById('logout').submit();
            }
        }
}
</script>