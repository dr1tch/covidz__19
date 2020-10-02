<template>
<div class="posts">
    <div v-if="ideas.length > 0" class="p-0 m-0" v-for="idea in ideas" :key="idea.id">
        <Post :idea="idea" :user='user'></Post>
    </div>
    <h2 v-else class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2>
</div>
</template>

<style scoped>
.posts {
    border: 1px #eee solid;
    border-top: none;
}
</style>

<script>
import Post from './Post'
export default {
    components: {
        Post
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
    // methods: {
    //     getLink(){
    //         console.log(this.user.id + '/getData');
    //         return this.user.id + '/getData';
    //     }
    // },
}
</script>
