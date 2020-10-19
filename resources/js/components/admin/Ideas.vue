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
                        <td class="hidden-sm" v-text="idea.title.substr(0, 15) + '....'"></td>
                        <!-- <td v-text="idea.body.substr(0, 20) + '....'"></td> -->
                        <!-- <td class="hidden-md">
                            <a v-if="idea.image" href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="idea.image" alt="">
                            </a>
                        </td> -->
                        <td><span class="btn-sm btn-warning font-weight-bold border-0" v-text="idea.category.name"></span></td>
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
                        <td class="hidden-sm" v-text="idea.title.substr(0, 15) + '....'"></td>
                        <!-- <td v-text="idea.body.substr(0, 20) + '....'"></td> -->
                        <!-- <td class="hidden-md">
                            <a v-if="idea.image" href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="idea.image" alt="">
                            </a>
                        </td> -->
                        <td><span class="btn-sm btn-warning font-weight-bold border-0" v-text="idea.category.name"></span></td>
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
                        <td class="hidden-sm" v-text="idea.title.substr(0, 15) + '....'"></td>
                        <!-- <td v-text="idea.body.substr(0, 20) + '....'"></td> -->
                        <!-- <td class="hidden-md">
                            <a v-if="idea.image" href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="idea.image" alt="">
                            </a>
                        </td> -->
                        <td><span class="btn-sm btn-warning font-weight-bold border-0" v-text="idea.category.name"></span></td>
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

            // approved: {
            //     data: [],
            //     per_page: 4,
            //     current_page: '',
            //     from: '',
            //     to: '',
            //     next_page_url: '',
            //     prev_page_url: '',
            //     total: '',
            //     last_page: '',
            // },
            // refused: {
            //     data: [],
            //     per_page: 4,
            //     current_page: '',
            //     from: '',
            //     to: '',
            //     next_page_url: '',
            //     prev_page_url: '',
            //     total: '',
            //     last_page: '',
            // },
            // pending: {
            //     data: [],
            //     per_page: 4,
            //     current_page: '',
            //     from: '',
            //     to: '',
            //     next_page_url: '',
            //     prev_page_url: '',
            //     total: '',
            //     last_page: '',
            // },

            data: new FormData(),

            ideaId: {},
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
                    this.approved = responce.approved;                    }).catch(error => {
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
                    this.approved = responce.approved;                    }).catch(error => {
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
                    this.approved = responce.approved;                    }).catch(error => {
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
            this.$modal.show(modal);
            this.ideaId = idea;
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
