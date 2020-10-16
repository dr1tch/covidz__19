<template>
     <div>
    <div class="main-wall-header flex justify-content-between align-item-center">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1>
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
        <Posts :len='$store.state.bookmarks.length' :ideas="$store.state.bookmarks" :route='$route.name'></Posts>

</div>
</template>

<style scoped>
</style>

<script>
import Posts from './templates/Posts'
export default {
    data() {
        return {
            bookmarks: [],
        }
    },

    components: {
        Posts
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.bookmarks = this.getBookmarks();
        console.log(`bookmarks: ${this.getBookmarks()}`);
        this.$Progress.finish();
    },
    computed: {
       
    },
    methods: {
         getBookmarks(){
            return this.$store.state.bookmarks;
        },
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