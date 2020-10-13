<template>
    <div>
        <div class="posts" v-if="ideas.length">
            <div class="p-0 m-0" v-for="idea in ideas" :key="idea.id">
                <Post :idea="idea" ></Post> 
            </div>
	    </div>
        <div class="posts" v-else>
            <h2  class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2>
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
        // isBookmarked(data){
        //     return this.$store.state.bookmarks.filter(b => b.id == data.id);
        // }
    }
}
</script>