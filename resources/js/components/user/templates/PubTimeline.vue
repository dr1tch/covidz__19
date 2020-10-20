<template>
    <div>
        <div class="posts" v-if="len">
            <div class="p-0 m-0" v-for="pub in pubs" :key="pub.id">
                <Post @booked="$emit('booked', true)" :pub='pub' @liked="reload"></Post> 
             </div> 
        </div>
        <div class="posts" v-else>
                <h2 class="alert text-center p-5 text-warning">No Publications Found!</h2>
        </div>
    </div>
</template>

<style scoped>
    .posts {
        border: 1px #eee solid;
        border-top: none;
        margin-right: 0;
        max-width: 100%;
    }
    .dropdown-item:hover,
    .dropdown-item:focus,
    .dropdown-item:visited,
    .dropdown-item:active {
        color: inherit;
        border: none !important;
        text-decoration: none;
        background-color: inherit;
        outline: none;
    }
</style>

<script>
import Post from './PubPost'
export default {
    data() {
        return {
            
        }
    },
    components: {
        Post,
    },
    props: ["pubs", 'len'],
    methods: {
        reload(e){
            // this.$Progress.start();
            if(e){
                // this.$Progress.start();
                this.callAPI('get', '/publications/data/all')
                .then((responce) => {
                    // this.ideas = responce;
                    this.$emit('edited', responce);
                })
                .catch((error) => {
                    console.log(error);
                    // this.$Progress.fail();
                });
                // this.$Progress.finish();
            }
            // this.$Progress.finish;
        },
    },
}
</script>