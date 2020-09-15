<template lang="">
<div>
    <div class="container main-wall border-0">
        Hello,
        Welcome Boss!
    </div>

    
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
        Sidebar,
        Navbar,
    },
    
}
</script>
