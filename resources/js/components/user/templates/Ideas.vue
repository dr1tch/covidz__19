<template >
    <div class="posts">
         <!-- <div v-if="ideas.length > 0" class="p-0 m-0" v-for="idea in ideas" :key="idea.id"> -->
                <Post :idea="user"></Post> 
            <!-- </div> -->
            <!-- <h2 v-else class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2> -->
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
    props: ['user'],
    // data() {
    //     return {
    //         ideas: '',
    //         username: '',
    //     }
    // },
    mounted() {
        // console.log(this.user);
         axios.get(`/getData/${this.user.id}`)
            .then((response) => {
                this.ideas = response.ideas;
            })
            .catch((errors) => {
                console.log(errors);
            });
            this.getLink();
    },
    // methods: {
    //     getLink(){
    //         console.log(this.user.id + '/getData');
    //         return this.user.id + '/getData';
    //     }
    // },
}
</script>