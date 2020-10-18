<template>
    <div>
        <div class="posts" v-if="pubs">
            <div class="p-0 m-0" v-for="pub in pubs" :key="pub.id">
                <Post :pub='pub'></Post> 
             </div> 
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
    props: ["pubs"],
}
</script>