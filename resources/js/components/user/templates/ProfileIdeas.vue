<template>
<div class="posts">
    <div v-if="isEmpty" class="p-0 m-0" v-for="idea in ideas" :key="idea.id">
        <ProfilePost :idea="idea" :user='user'></ProfilePost>
    </div>
    <div v-else class="p-0 m-0">
        <h2 class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2>
    </div>
</div>
</template>

<style scoped>
.posts {
    border: 1px #eee solid;
    border-top: none;
}
</style>

<script>
import ProfilePost from './ProfilePost'
export default {
    components: {
        ProfilePost
    },
    props: ['user', 'ideas'],
    // data() {
    //     return {
    //         ideas: '',
    //         username: '',
    //     }
    // },
    mounted() {
        
    },
    computed: {
        isEmpty() {
            return this.user.ideas.length;
        }
    },
    methods: {

    },
}
</script>
