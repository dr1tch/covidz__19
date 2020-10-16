<template>
<div>
    <div class="posts" v-if="len">
        <div class="p-0 m-0" v-for="idea in ideas" :key="idea.id">
            <Post @reload='reload' :idea="idea" @open='setIdea' :route="route"></Post> 
        </div> 
    </div>
    
    <div class="posts" v-else>
        <div v-if="$route.name == 'Bookmarks'">
                    <h2 class="alert text-center p-5 text-warning">NO BOOKMARKS ADDED YET!!!!</h2>
        </div>
         <div v-else>
                    <h2 class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2>
        </div>
    </div>
      <!-- Edit Ideas Modal -->
    <modal name="edit-idea-modal" height="auto" width="600px" classes="text-light bg-secondary">
        <div>

            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold">Edit Idea</h4>
                </div>
                <form action="" method="POST" @submit.prevent="editIdea" enctype="multipart/form-data" @change="clear($event.target.name)" @keyup="clear($event.target.name)">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Title ..." v-model="title">
                                <!-- <span class=" alert text-danger" v-if="errors" v-text="errors.title[0]"></span> -->
                            </div>
                            <div class="col-md-6">
                                <select @change="clear($event.target.name)" name="" v-model="category" id="" class="form-control bg-secondary text-light mb-3">
                                    <option value="" disabled>Category...</option>
                                    <option v-for="cat in $store.state.categories" :key="cat.id" :value="cat.id" :selected="cat.id == category">{{cat.name}}</option>
                                </select>
                                 <!-- <span class=" alert text-danger" v-if="errors" v-text="errors.category[0]"></span> -->
                            </div>

                        </div>
                        <div>
                            <textarea type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Body ..." v-model="body"></textarea>
                            <!-- <span class=" alert text-danger" v-if="errors" v-text="errors.body[0]"></span> -->
                        </div>
                        <div class="flex justify-content-between align-items-center p-2">
                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Select a Cover Image">
                                <label for="path" class="flex" style="margin-bottom: 0;">
                                    <div>
                                        <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </div>
                                </label>
                            </button>
                            <input type="file" name="path" id="path" @change="newCover" style="display: none;">
                            <img :src="asset(cover)" alt="" class="img-preview img-fluid rounded-lg "  width="100px" v-if="! imgPreview">
                            <img :src="imgPreview" alt="" class="img-preview img-fluid rounded-lg" v-if="imgPreview"  width="100px">
                            <!-- <span class=" alert text-danger" v-if="errors.image" v-text="errors.image[0]"></span> -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex align-items-center justify-content-between">
                            <button type="button" @click="$modal.hide('add-idea-modal')" class="btn btn-sm btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Edit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </modal>
    <!-- Delete Idea Modal -->

        <modal name="delete-idea-modal" height="auto" width="500px" classes="text-light bg-secondary">
            <div class="card">
                <!-- <div class="card-header">
                            <h4 class="font-weight-bold">Delete </h4>
                        </div> -->
                    <div class="card-body">
                        <div>
                            <h5 class="alert font-size-lg m-auto text-center">Are You Sure you want to delete <span class="font-weight-bold text-warning">{{'@'+ideaId.title}}</span> ?</h5>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex align-items-center justify-content-between">
                            <button type="button" @click="$modal.hide('delete-idea-modal')" class="btn btn-sm btn-danger">Cancel</button>
                            <button type="button" @click='deleteIdea(ideaId.id)' class="btn btn-sm btn-success" :disabled="any(errors)">Delete</button>
                        </div>
                    </div>
            </div>
        </modal>
</div>
</template>

<style scoped>
.posts {
    border: 1px #eee solid;
    border-top: none;
}
.bookmark {
    margin-right: 2%;
    width: 30%;
    justify-content: flex-end;
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
import Post from './Post'
import moment from 'moment'

export default {
    data() {
        return {
            idea: {},
            data: new FormData(),
            bookmarked: '',
            title: '',
            category: '',
            body: '',
            cover: '',
            imgPreview: '',
            ideaId: '',
            id: '',
            errors:'',
            length: true,
        }
    },
    components: {
        Post,
    },
    props: ["ideas", "route", 'len'],
    beforeMount() {
        // this.$Progress.start();
    },
    computed: {
    },
    mounted() {
        // this.$Progress.finish();
        this.$store.commit('isBooked', this.idea);
        // this.ideas = this.ideas.reverse();
        this.length = this.ideas.length;
        // console.log('length: ' + this.ideas.length);
    },
    methods: {
       getPath(imgSrc) {
            console.log(imgSrc);
            return '/storage/' + imgSrc;
        },
        getProfile(imgPath) {
            return '/images' + imgPath;
        },
        postedOn(idea) {
            return moment(idea.created_at).fromNow();
        },
        exist(path) {
            return path !== null;
        },
        newCover(event) {
            let files = event.target.files;
            console.log("file: " + files[0]);
            if (files.length) this.cover = files[0];
            // else this.cover = this.imgPreview;
            console.log(this.cover)
            this.imgPreview = URL.createObjectURL(event.target.files[0]);
        },

        showModal(modal, data) {
            this.$modal.show(modal);
            this.ideaId = data;
            this.title = data.title;
            this.category = data.category_id;
            this.body = data.body;
            // this.cover = data.image;
            // this.imgPreview = this.cover;
        },
        setIdea(id){
            console.log(id);
            this.ideaId = id;
            this.id = id.id;
            this.title = id.title;
            this.category = id.category_id;
            this.body = id.body;
            // this.cover = id.image;
            this.imgPreview = '/storage/' + id.image;
        },
        clear(field){
            console.log(field);
            if(field){
                delete this.errors[field];
                return;
            }
            this.errors = {};
        },
        reload(e){
            // this.$Progress.start();
            if(e){
                // this.$Progress.start();
                this.callAPI('get', '/ideas/data')
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

        // Ideas API:
        editIdea(){
            this.$Progress.start();
            this.data.set('title', this.title);
            this.data.set('body', this.body);
            this.data.set('image', this.cover);
            this.data.set("category_id", this.category);
            this.data.set('_method', "patch");
            this.callAPI('post', `/ideas/${this.id}/update`, this.data)
                .then((response) => {
                    console.log(response);
                                   
                }).then(() => {
                    this.callAPI('get', '/ideas/data')
                        .then((response) => {
                            // this.ideas = response;
                            this.$emit('edited', response);
                            console.log(response);
                        })
                })
                .then(() => {
                    this.$modal.hide("edit-idea-modal");
                    this.title = '';
                    this.body = '';
                    this.cover = '';
                    this.imgPreview = '';
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.errors;
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        deleteIdea(id){
            this.$Progress.start();
            this.data.set('_method', 'patch');
            this.callAPI('post', `/ideas/${id}/delete`, this.data)
                .then((responce) => {
                }).then(() => {
                    this.callAPI('get', '/ideas/data')
                        .then((response) => {
                            this.ideaId = response;
                            this.$emit('edited', response);
                            console.log(response);
                        })
                })
                .then(() => {
                    this.$modal.hide("delete-idea-modal");
                    this.title = '';
                    this.body = '';
                    this.cover = '';
                    this.imgPreview = '';
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.errors;
                    this.$progress.fail();
                });
            this.$Progress.finish();
        }


        // Problem in validating images. TODO: 
    }
}
</script>
