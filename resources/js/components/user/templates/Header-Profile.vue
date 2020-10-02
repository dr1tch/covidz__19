<template lang="">
<div class="posts">
    <div class="block" style="height: 335px;">
        <div>
            <img src="/images/Twitter-Banner.png" alt="" class="img-fluid">
        </div>
        <div class="flex justify-content-center align-items-center">
            <img class="rounded-circle mr-2 transform" width="150" height="150" :src="user.avatar" alt="">
        </div>
    </div>
    <div class="flex justify-content-between align-items-center px-4">
        <div>
            <h3 class="mb-0 font-weight-bold" v-text="user.fname + ' ' + user.lname"></h3>
            <span class="text-secondary text-sm" v-text="'@' + user.username"></span>
            <div class="flex align-items-center justify-content-start mt-2">
                <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-calendar3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                    <path fill-rule="evenodd" d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                </svg>
                <span class="ml-2 text-secondary">Joined {{ moment(user.created_at).fromNow() }}</span>
            </div>
            <p class="mt-4 font-weight-bold" v-text="user.bio"></p>
        </div>
        <div style="margin-top: -15%; display: block;">
            <button type="button" class="btn btn-outline-light rounded-pill full-width">Edit Profile</button>
            <button type="button" class="btn btn-success rounded-pill">Follow</button>
            <button type="button" class="btn btn-outline-success rounded-pill">Unfollow</button>
        </div>
    </div>

</div>
</template>

<style scoped>
.posts {
    border: 1px #eee solid;
    border-top: none;
    
    /* top: 63px; */
}

img.transform {
    transform: translateY(-50%);
    width: 150px;
    height: 150px;
}
</style>

<script>
import moment from 'moment'
export default {
    props: ["user"],
}
</script>
