<template>
        <div class="posts">
            <div v-if="ideas" class="p-0 m-0" v-for="idea in ideas" :key="idea.id">
                <Post :idea="idea" ></Post> 
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
    data() {
        return {
            idea: {},
        }
    },
    components: {
        Post,
    }, 
    props: [ "ideas" ],
    methods: {
        // getUser(id){
        //     return this.users.filter(user => user.id === id);
        // },
        // getPost(idea){
        //     // console.log(idea);
        //     this.idea = idea;
        //     this.idea.user = this.getUser(idea.user_id);
        //     // console.log(this.idea);
        //     return this.idea;
        // }
    }
}
</script>