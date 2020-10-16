<template>
    <div>
        <Header :route ="$route.name"></Header>
        <ProfileHeader :user="userInfo.user"></ProfileHeader>
        <ProfileIdeas :user="userInfo.user" :ideas='userInfo.ideas'></ProfileIdeas>
        
    </div>
</template>

<script>
import ProfileHeader from './templates/Header-Profile'
import Header from './templates/header'
import ProfileIdeas from './templates/ProfileIdeas'
export default {
    data() {
        return {
            userInfo: '',
            path: this.$route.path,
        }
    },
    components: {
        ProfileHeader,
        ProfileIdeas,
        Header,
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.callAPI('get', `/getData${this.path}`).then((response) => {
            this.userInfo = response;
            console.log(this.userInfo);
        }).catch(error => {
            console.log(error);
            this.$Progress.fail();
        });
        this.$Progress.finish();
    }
}
</script>