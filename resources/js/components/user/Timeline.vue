<template>
<div>
    <div class="main-wall-header flex justify-content-between align-item-center">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="route"></h1>
        <div class="flex justify-content-center align-items-center ">
            <form action="/ideas/find" method="POST" @submit.prevent="categoryOrder" class="flex justify-content-center align-items-center ">
                <select name="" v-model="category" id="" class="form-control-sm bg-secondary text-light mr-2">
                    <option value="" selected="selected" disabled>Category...</option>
                    <!-- <option value="9999" selected="selected">Show All</option> -->
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

        </div>
    </div>
    <Posts :ideas="ideas" @edited='updateData' ></Posts>
</div>
</template>

<style scoped>



</style>

<script>
// import Header from './templates/header'
import Posts from './templates/Posts'
export default {
    data() {
        return {
            // users: [],
            ideas: [],
            cover: '',
            title: '',
            body: '',
            imgPreview: '',
            data: new FormData(),
            category: '',
        }
    },
    components: {
        // Header,
        Posts,
    },
    mounted() {
        this.getData();
    },
    computed: {
        route() {
            return this.$route.name;
        }
    },
    methods: {

        newCover(event) {
            let files = event.target.files;
            console.log("file: " + files[0]);
            if (files.length) this.cover = files[0];
            console.log(this.cover)
            this.imgPreview = URL.createObjectURL(event.target.files[0]);
        },
        updateData(e){
            this.ideas = e;
        },

        // Ideas APIs
        getData() {
            this.callAPI('get', '/ideas/data')
                .then((response) => {
                    console.log(response);
                    this.ideas = response[0];
                })
        },
        addIdea() {
            this.data.set('title', this.title);
            this.data.set('body', this.body);
            this.data.set('image', this.cover);
            this.data.set('_method', "patch");
            this.callAPI('post', '/ideas/create', this.data)
                .then((response) => {
                    console.log(response);
                }).then(() => {
                    this.callAPI('get', '/ideas/data')
                        .then((response) => {
                            this.ideas = response[0];
                            console.log(response);
                        })
                })
                .then(() => {
                    this.$modal.hide("add-idea-modal")
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        categoryOrder() {
            // if (this.category == 9999) {
            //     this.getData();
            // } else {
                this.data.set('category_id', this.category);
                this.data.set('_method', "patch");
                this.callAPI('post', '/ideas/find', this.data)
                    .then((responce) => {
                        console.log(responce);
                        this.ideas = responce.approved.data;
                    })
                    .then()
                    .catch((errors) => {
                        console.log(errors);
                    });
            // }
        }
    }
}
</script>
