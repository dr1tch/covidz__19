<template lang="">
<div>
    <div class='flex justify-content-center align-items-center alert alert-success width-auto'>
        Hello,
        Welcome User!
    </div>
    <a class="btn btn-outline-danger" @click="logout">Log Out</a>
                    <form style="display: hidden" action="/logout" method="POST" id="logout">
                        <input type="hidden" name="_token" :value="csrf_token"/>
                    </form>
                    </div>
</template>




<script>
export default {
     data() {
            return {
                csrf_token: window.csrf_token
            }
        },
        methods: {
            logout() {
                document.getElementById('logout').submit();
            }
        }
}
</script>