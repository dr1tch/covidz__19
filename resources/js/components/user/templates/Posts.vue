<template>
<div>
    <div class="posts" v-if="ideas.length">
        <div class="p-0 m-0" v-for="idea in ideas" :key="idea.id">
            <Post :idea="idea" @open='setIdea'></Post> 
        </div> 
    </div>
    
    <div class="posts" v-else>
        <h2 class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2>
    </div>
      <!-- Edit Ideas Modal -->
    <modal name="edit-idea-modal" height="auto" width="600px" classes="text-light bg-secondary">
        <div>

            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold">Edit Idea</h4>
                </div>
                <form action="" method="POST" @submit.prevent="editIdea" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Title ..." v-model="title">
                                <!-- <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span> -->
                            </div>
                            <div class="col-md-6">
                                <select name="" v-model="category" id="" class="form-control bg-secondary text-light mb-3">
                                    <option value="" disabled>Category...</option>
                                    <option v-for="cat in $store.state.categories" :key="cat.id" :value="cat.id" :selected="cat.id == category">{{cat.name}}</option>
                                </select>
                            </div>

                        </div>
                        <div>
                            <textarea type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Body ..." v-model="body"></textarea>
                            <!-- <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span> -->
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
                            <img :src="imgPreview" alt="" class="img-preview img-fluid rounded-lg" width="100px">
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
        }
    },
    mounted() {
        // this.$store.commit('isBooked', this.idea);
        console.log(this.ideas.length);
        
    },
    components: {
        Post,
    },
    props: ["ideas"],
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
            // this.cover = '/storage/' + data.image;
            // this.imgPreview = this.cover;
        },
        setIdea(id){
            console.log(id);
            this.ideaId = id;
            this.id = id.id;
            this.title = id.title;
            this.category = id.category_id;
            this.body = id.body;
            this.imgPreview = id.image;
        },


        // Ideas API:
        editIdea(){
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
                            this.ideaId = response;
                            this.$emit('edited', response[0]);
                            console.log(response[0]);
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
                });
        }

        // Problem in validating images. TODO: 
    }
}
</script>
