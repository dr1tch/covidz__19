<template>
<div>
    <div class="card bg-card" id="pending">
        <div class="card-header flex justify-content-between align-items-center">
            <div class="flex align-items-baseline">
                <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1><span>{{ '/' + page }}</span>
            </div>
            <div class="flex justify-content-center align-items-center ">
                <button @click="pending_button" type="button" class="btn btn-sm btn-light ml-2">Pending</button>
                <button @click="approved_button" type="button" class="btn btn-sm btn-light ml-2">Approved</button>
                <button @click="refused_button" type="button" class="btn btn-sm btn-light ml-2">Refused</button>

            </div>
        </div>
        <div class='table-responsive card-body'>
            <table class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th class="hidden-sm">Title</th>
                        <!-- <th>Body</th> -->
                        <!-- <th class="hidden-md">Reporter Profile</th> -->
                        <!-- <th>Cover</th> -->
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="idea in pending" :key="idea.id">
                        <td v-text="idea.id"></td>
                        <td class="hidden-sm"> <a class="alert-link" @click="showModal('show-idea-modal', idea)">{{idea.title.substr(0, 15) + '....'}}</a></td>
                        <!-- <td v-text="idea.body.substr(0, 20) + '....'"></td> -->
                        <!-- <td class="hidden-md">
                            <a v-if="idea.image" href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="idea.image" alt="">
                            </a>
                        </td> -->
                        <td><span class="btn-sm btn-dark font-weight-bold border-0" v-text="idea.category.name"></span></td>
                        <td class="hidden-md" v-text="moment(idea.created_at).format('DD-MM-YYYY')"></td>
                        <td><span class="btn-sm btn-info font-weight-bold border-0">pending</span></td>
                        <td>
                            <div>
                                <button @click.prevent="approveIdea(idea.id)" type="button" class="btn btn-sm btn-success">Approve</button>
                                <button @click.prevent="refuseIdea(idea.id)" type="button" class="btn btn-sm btn-warning">Refuse</button>
                                <button @click.prevent="showModal('edit-idea-modal', idea)" type="button" class="btn btn-sm btn-primary">Edit</button>
                                <button @click.prevent="showModal('delete-idea-modal', idea)" type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">

        </div>
    </div>
    <div class="card bg-card" id="approved" style="display: none">
        <div class="card-header flex justify-content-between align-items-center">
            <div class="flex align-items-baseline">
                <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1><span>{{ '/' + page }}</span>
            </div>
            <div class="flex justify-content-center align-items-center ">
                <button @click="pending_button" type="button" class="btn btn-sm btn-light ml-2">Pending</button>
                <button @click="approved_button" type="button" class="btn btn-sm btn-light ml-2">Approved</button>
                <button @click="refused_button" type="button" class="btn btn-sm btn-light ml-2">Refused</button>

            </div>
        </div>
        <div class='table-responsive card-body'>
            <table class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th class="hidden-sm">Title</th>
                        <th>Likes</th>
                        <!-- <th>Body</th> -->
                        <!-- <th class="hidden-md">Reporter Profile</th> -->
                        <!-- <th>Cover</th> -->
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="idea in approved" :key="idea.id">

                        <td v-text="idea.id"></td>
                        <td class="hidden-sm"> <a class="alert-link" @click="showModal('show-idea-modal', idea)">{{idea.title.substr(0, 15) + '....'}}</a></td>
                        <!-- <td v-text="idea.body.substr(0, 20) + '....'"></td> -->
                        <!-- <td class="hidden-md">
                            <a v-if="idea.image" href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="idea.image" alt="">
                            </a>
                        </td> -->
                        <td v-text="idea.likes"></td>
                        <td><span class="btn-sm btn-dark font-weight-bold border-0" v-text="idea.category.name"></span></td>
                        <td class="hidden-md" v-text="moment(idea.created_at).format('DD-MM-YYYY')"></td>
                        <td><span class="btn-sm btn-success font-weight-bold border-0">approved</span></td>
                        <td>
                            <div>
                                <!-- <button @click.prevent="approveIdea(idea.id)" type="button" class="btn btn-sm btn-success">Approve</button> -->
                                <!-- <button @click.prevent="refuseIdea(idea.id)" type="button" class="btn btn-sm btn-success">Refuse</button> -->
                                <button @click.prevent="showModal('edit-idea-modal', idea)" type="button" class="btn btn-sm btn-primary">Edit</button>
                                <button @click.prevent="showModal('delete-idea-modal', idea)" type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer">

        </div>
    </div>

    <div class="card bg-card" id="refused" style="display: none">
        <div class="card-header flex justify-content-between align-items-center">
            <div class="flex align-items-baseline">
                <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1><span>{{ '/' + page }}</span>
            </div>
            <div class="flex justify-content-center align-items-center ">
                <button @click="pending_button" type="button" class="btn btn-sm btn-light ml-2">Pending</button>
                <button @click="approved_button" type="button" class="btn btn-sm btn-light ml-2">Approved</button>
                <button @click="refused_button" type="button" class="btn btn-sm btn-light ml-2">Refused</button>

            </div>
        </div>
        <div class='table-responsive card-body'>
            <table class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th class="hidden-sm">Title</th>
                        <!-- <th>Body</th> -->
                        <!-- <th class="hidden-md">Reporter Profile</th> -->
                        <!-- <th>Cover</th> -->
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="idea in refused" :key="idea.id">

                        <td v-text="idea.id"></td>
                        <td class="hidden-sm"> <a class="alert-link" @click="showModal('show-idea-modal', idea)">{{idea.title.substr(0, 15) + '....'}}</a></td>
                        <!-- <td v-text="idea.body.substr(0, 20) + '....'"></td> -->
                        <!-- <td class="hidden-md">
                            <a v-if="idea.image" href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="idea.image" alt="">
                            </a>
                        </td> -->
                        <td><span class="btn-sm btn-dark font-weight-bold border-0" v-text="idea.category.name"></span></td>
                        <td class="hidden-md" v-text="moment(idea.created_at).format('DD-MM-YYYY')"></td>
                        <td><span class="btn-sm btn-danger font-weight-bold border-0">refused</span></td>
                        <td>
                            <div>
                                <!-- <button @click.prevent="approveIdea(idea.id)" type="button" class="btn btn-sm btn-success">Approve</button> -->
                                <!-- <button @click.prevent="refuseIdea(idea.id)" type="button" class="btn btn-sm btn-success">Refuse</button> -->
                                <!-- <button @click.prevent="showModal('edit-idea-modal', idea)" type="button" class="btn btn-sm btn-danger">Edit</button> -->
                                <button @click.prevent="showModal('delete-idea-modal', idea)" type="button" class="btn btn-sm btn-success">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <!-- Show Ideas Model -->
    <modal name="show-idea-modal" height="auto" width="750px" classes="text-light bg-secondary">
        <div class="flex justify-content-stretch align-items-center">

            <div class="p-0 m-0">
                <div style="width: 400px">
                    <img class="post-media" :src="getPath(ideaId.image)">
                </div>
            </div>
            <div class="post flex mx-3">
                <div style="width: -webkit-fill-available;">
                    <div class="post-header text-light">
                            <div class="post-body">
                                <div class="text flex">
                                    <h4 class="text-success font-weight-bold" v-text="ideaId.title"></h4>
                                </div>
                                <div class="mb-3">
                                    <span class='ml-2' style="font-size: 0.9em; color: #999">{{ postedOn(ideaId) }}</span>
                                </div>
                                <div class="text">
                                    <p v-text="ideaId.body"></p>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>

    </modal>

    <!-- Edit Idea Modal -->
    <modal name="edit-idea-modal" height="auto" width="600px" classes="text-light bg-secondary">
        <div>

            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold">Edit <span class=" text-danger">{{ideaId.title}}</span></h4>
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
                            <button type="button" @click="$modal.hide('edit-idea-modal')" class="btn btn-sm btn-danger">Cancel</button>
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
                    <button type="button" @click='deleteIdea(ideaId.id)' class="btn btn-sm btn-success">Delete</button>
                </div>
            </div>
        </div>
    </modal>
</div>
</template>

<style scoped>
.post {
    border: none;
}

.post:hover {
    border: none;
    background: transparent !important;
}

.post-media {
    border-radius: 0;
}
</style>

<script>
import moment from 'moment'
export default {
    data() {
        return {
            id: 0,
            current: '',
            approved: '',
            refused: '',
            pending: '',
            page: 'Pending',
            data: new FormData(),
            image: '',
            imgPreview: '',
            ideaId: '',
            title: '',
            category: '',
            body: '',
            cover: '',
            id: '',
        }
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.id = 0;
        this.getData();
        // this.current = this.pending;
        this.$Progress.finish();
        // this.ideaId = this.pending[0];
    },
    computed: {
        routeName() {
            return this.$route.name;
        },
    },
    methods: {
        pending_button() {
            document.getElementById('pending').style.display = 'flex';
            document.getElementById('refused').style.display = 'none';
            document.getElementById('approved').style.display = 'none';
            this.page = 'Pending'
        },
        refused_button() {
            document.getElementById('pending').style.display = 'none';
            document.getElementById('refused').style.display = 'flex';
            document.getElementById('approved').style.display = 'none';
            this.page = 'Refused'
        },
        approved_button() {
            document.getElementById('pending').style.display = 'none';
            document.getElementById('refused').style.display = 'none';
            document.getElementById('approved').style.display = 'flex';
            this.page = 'Approved'

        },

        getData() {
            this.data.set('status', this.id)
            this.callAPI('get', '/admin/ideas/data')
                .then((responce) => {
                    console.log(responce)
                    this.pending = responce.pending;
                    this.refused = responce.refused;
                    this.approved = responce.approved;
                }).catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
        },
        afterRequest(responce) {
            this.pending = responce.pending;
            this.refused = responce.refused;
            this.approved = responce.approved;
        },
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
            if (files.length) this.image = files[0];
            console.log(this.cover)
            this.imgPreview = URL.createObjectURL(event.target.files[0]);
        },

        show() {
            if (this.id == 0) {
                this.current = this.pending;
            } else if (this.id == 1) {
                this.current = this.approved;
            } else if (this.id == 2) {
                this.current = this.refused;
            }

        },
        // Ideas API:
        approveIdea(id) {
            this.$Progress.start();
            this.data.set('status', 1);
            this.callAPI('post', `/admin/ideas/${id}/actions`, this.data)
                .then(() => this.callAPI('get', '/admin/ideas/data')
                    .then((responce) => {
                        this.pending = responce.pending;
                        this.refused = responce.refused;
                        this.approved = responce.approved;
                    }).catch(error => {
                        console.log(error);
                        this.$Progress.fail();
                    })
                )
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        refuseIdea(id) {
            this.$Progress.start();
            this.data.set('status', 2);
            this.callAPI('post', `/admin/ideas/${id}/actions`, this.data)
                .then(() => this.callAPI('get', '/admin/ideas/data')
                    .then((responce) => {
                        this.pending = responce.pending;
                        this.refused = responce.refused;
                        this.approved = responce.approved;
                    }).catch(error => {
                        console.log(error);
                        this.$Progress.fail();
                    })
                )
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        updateIdea(id) {
            this.$Progress.start();
            this.data.set('status', 1);
            this.callAPI('post', `/admin/ideas/${id}/actions`, this.data)
                .then(() => this.callAPI('get', '/admin/ideas/data')
                    .then((responce) => {
                        this.pending = responce.pending;
                        this.refused = responce.refused;
                        this.approved = responce.approved;
                    }).catch(error => {
                        console.log(error);
                        this.$Progress.fail();
                    })
                )
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        showModal(modal, idea) {
 
            console.log(idea);
            this.ideaId = idea;
            this.title = idea.title;
            this.category = idea.category_id;
            this.body = idea.body;
            this.id = idea.id;
            this.imgPreview = '/storage/' + idea.image;
            this.$modal.show(modal);
        },
        editIdea(){
            this.$Progress.start();
            this.data.set('title', this.title);
            this.data.set('body', this.body);
            this.data.set('image', this.cover);
            this.data.set("category_id", this.category);
            this.data.set('_method', "patch");
            this.callAPI('post', `/admin/ideas/${this.id}/update`, this.data)
                .then((response) => {
                    console.log(response);
                                   
                }).then(() => {
                    this.callAPI('get', '/admin/ideas/data')
                        .then((response) => {
                            this.pending = response.pending;
                            this.refused = response.refused;
                            this.approved = response.approved;
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
        deleteIdea(id) {
            this.$Progress.start();
            this.callAPI('post', `/admin/ideas/${id}/delete`)
                .then((responce) => this.$modal.hide("delete-idea-modal"))
                .then(() => this.callAPI('get', '/admin/ideas/data')
                    .then((responce) => {
                        this.afterRequest(responce);
                    }).catch(error => {
                        console.log(error);
                        this.$Progress.fail();
                    })
                )
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        }

    },
}
</script>
