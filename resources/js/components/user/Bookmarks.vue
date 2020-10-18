<template>
<div v-if="$store.state.auth">
    <div class="main-wall-header flex justify-content-between align-item-center">
        <div class="flex align-items-baseline">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1><span>{{ '/' + path }}</span>
        </div>
        <div class="flex justify-content-end align-item-center">
            <button class="btn btn-sm btn-light font-weight-bold mr-2" style="height: fit-content" @click="ideas">
                Ideas
            </button>
            <button class="btn btn-sm btn-secondary font-weight-bold" style="height: fit-content" @click="pubs">
                Publication
            </button>
        </div>
        <!-- <div class="flex justify-content-center align-items-center ">
            <form action="/ideas/find" method="POST" @submit.prevent="categoryOrder" class="flex justify-content-center align-items-center ">
                <select name="" v-model="category" id="" class="form-control-sm bg-secondary text-light mr-2">
                    <option value="" selected="selected" disabled>Category...</option>
                    <option v-for="category in $store.state.categories" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>
                <button type="submit" class="btn btn-sm btn-info font-weight-bold mr-2">
                    Show
                </button>
                
            </form>
            <div>
                <button @click='getData' class="btn btn-sm btn-success font-weight-bold">
                    ShowAll
                </button>
            </div>
        </div> -->
    </div>
    <!-- <Posts :ideas="$store.state.bookmarks" @edited='updateData' :route='$route.name'></Posts> -->
        <Posts v-if="!showPubs && $store.state.auth" :len='$store.state.bookmarks.length' :ideas="$store.state.bookmarks" :route='$route.name'></Posts>
        <PubTimeline @booked='event' v-if="showPubs && $store.state.auth" :pubs='$store.state.pubsBookmarks' :len="$store.state.pubsBookmarks.length"></PubTimeline>

</div>
</template>

<style scoped>
</style>

<script>
import Posts from './templates/Posts'
import PubTimeline from './templates/PubTimeline'

export default {
    data() {
        return {
            bookmarks: [],
            showPubs: true,
        }
    },

    components: {
        Posts,
        PubTimeline
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.showPubs = true;
        if(!this.showPubs){
            this.bookmarks = this.getIdeasBookmarks();
            console.log(`bookmarks: ${this.getIdeasBookmarks()}`);
            
        } else {
            this.getPubsBookmarks();
        }

        this.$Progress.finish();
        
    },
    computed: {
       path(){
           return this.showPubs ? 'Publications' : 'Ideas';
       }
    },
    methods: {
         getIdeasBookmarks(){
            return this.$store.state.bookmarks;
        },
         getPubsBookmarks(){
            this.callAPI('get', '/get/bookmarks')
                .then((responce) => {
                    this.bookmarks = responce;
                })
                .catch(error => console.log(error));
        },
        pubs(){
            this.bookmarks = this.$store.getters.getPubsBookmarks;
            this.showPubs = true;
        },
        ideas(){
            this.bookmarks = this.$store.getters.getIdeasBookmarks;
            this.showPubs = false;
        },
        event(e){
            if(e){
                this.getPubsBookmarks();
            }
        }
        // updateData(e){
        //     this.ideas = e;
        // },
        // getData(){
        //     this.bookmarks = this.$store.state.bookmarks;
        // },
        // categoryOrder() {
        //         this.data.set('category_id', this.category);
        //         this.data.set('_method', "patch");
        //         this.callAPI('post', '/bookmarks/find', this.data)
        //             .then((responce) => {
        //                 console.log(responce);
        //                 this.bookmarks = responce;
        //             })
        //             .then()
        //             .catch((errors) => {
        //                 console.log(errors);
        //             });
        // }
    },
}
</script>