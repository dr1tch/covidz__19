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
                        <th>Cover</th>
                        <th>Category</th>
                        <th>Wilaya</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in pending" :key="report.id">
                        <td v-text="report.id"></td>
                        <td class="hidden-sm"> <a class="alert-link" @click="showModal('show-report-modal', report)">{{report.title.substr(0, 15) + '....'}}</a></td>
                        <!-- <td class="hidden-sm" v-text="report.body.substr(0, 30) + '....'"></td> -->
                        <td class="hidden-md">
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="'/storage/' + report.image" alt="">
                            </a>
                        </td>
                        <td><span class="btn-sm btn-secondary font-weight-bold border-0" v-text="report.category.name"></span></td>
                        <td><span class="btn-sm btn-dark font-weight-bold border-0" v-text="report.wilaya.name"></span></td>
                        <td class="hidden-md" v-text="moment(report.created_at).format('DD-MM-YYYY')"></td>
                        <td><span class="btn-sm btn-info font-weight-bold border-0">pending</span></td>
                        <td>
                            <div>
                                <button @click.prevent="approveReport(report.id)" type="button" class="btn btn-sm btn-success">Approve</button>
                                <button @click.prevent="showModal('delete-report-modal', report)" type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="card bg-card" id="approved" style="display: none;">
       <div class="card-header flex justify-content-between align-items-center">
            <div class="flex align-items-baseline">
                <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1><span>{{ '/' + page }}</span>
            </div>
            <div class="flex justify-content-center align-items-center ">
                <button @click="pending_button" type="button" class="btn btn-sm btn-light ml-2">Pending</button>
                <button @click="approved_button" type="button" class="btn btn-sm btn-light ml-2">Approved</button>
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
                        <th>Cover</th>
                        <th>Category</th>
                        <th>Wilaya</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in approved" :key="report.id">
                        <td v-text="report.id"></td>
                        <td class="hidden-sm"> <a class="alert-link" @click="showModal('show-report-modal', report)">{{report.title.substr(0, 15) + '....'}}</a></td>
                        <!-- <td class="hidden-sm" v-text="report.body.substr(0, 30) + '....'"></td> -->
                        <td class="hidden-md">
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="'/storage/' + report.image" alt="">
                            </a>
                        </td>
                        <td><span class="btn-sm btn-secondary font-weight-bold border-0" v-text="report.category.name"></span></td>
                        <td><span class="btn-sm btn-dark font-weight-bold border-0" v-text="report.wilaya.name"></span></td>
                        <td class="hidden-md" v-text="moment(report.created_at).format('DD-MM-YYYY')"></td>
                        <td><span class="btn-sm btn-info font-weight-bold border-0">pending</span></td>
                        <td>
                            <div>
                                <button @click.prevent="approveReport(report.id)" type="button" class="btn btn-sm btn-success">Approve</button>
                                <button @click.prevent="showModal('delete-report-modal', report)" type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <div class="card-footer">
            <div class=" flex justify-content-between align-items-center">
                <div class="my-4">
                    <ul class="pagination pagination-md justify-content-center text-center">
                        <li class="page-item" :class="from === 1 ? 'disabled' : ''">
                            <a class="page-link" @click="previousPage">
                                Previous
                            </a>
                        </li>
                        <li class="page-link" style="background-color: inherit">
                            {{ currentPage }} of {{ pages }}
                        </li>
                        <li class="page-item" :class="to === total ? 'disabled' : ''">
                            <a class="page-link" @click="nextPage">
                                Next
                            </a>
                        </li>
                    </ul>
                </div>
                <button type="button" @click.prevent="" class="btn btn-sm btn-danger">Delete All</button>
            </div>
        </div> -->
    </div>
    <!-- Show Report Modal -->
     <!-- Show Ideas Model -->
    <modal name="show-report-modal" height="auto" width="750px" classes="text-light bg-secondary">
        <div class="flex justify-content-stretch align-items-center">

            <div class="p-0 m-0">
                <div style="width: 400px">
                    <img class="post-media" :src="getPath(reportId.image)">
                </div>
            </div>
            <div class="post flex mx-3">
                <div style="width: -webkit-fill-available;">
                    <div class="post-header text-light">
                            <div class="post-body">
                                <div class="text flex">
                                    <h4 class="text-success font-weight-bold" v-text="reportId.title"></h4>
                                   <!--  <span class="btn-sm btn-warning font-weight-bold border-0" v-text="reportId.category.name"></span> -->
                                </div>
                                <div class="mb-3">
                                    <span class='ml-2' style="font-size: 0.9em; color: #999">{{ postedOn(reportId) }}</span>
                                </div>
                                <div class="text">
                                    <p v-text="reportId.body"></p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </modal>
    <!-- Delete User Modal -->

    <modal name="delete-report-modal" height="auto" width="500px" classes="text-light bg-secondary">
        <div class="card">
            <!-- <div class="card-header">
                            <h4 class="font-weight-bold">Delete </h4>
                        </div> -->
            <div class="card-body">
                <div>
                    <h5 class="alert font-size-lg m-auto text-center">Are You Sure you want to delete <span class="font-weight-bold text-warning">{{'@'+reportId.title}}</span> ?</h5>
                </div>
            </div>
            <div class="card-footer">
                <div class="flex align-items-center justify-content-between">
                    <button type="button" @click="$modal.hide('delete-report-modal')" class="btn btn-sm btn-danger">Cancel</button>
                    <button type="button" @click='deleteReport(reportId.id)' class="btn btn-sm btn-success">Delete</button>
                </div>
            </div>
            </form>

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
            approved: [],
            pending: [],
            currentPage: '',
            from: '',
            to: '',
            next: '',
            prev: '',
            total: '',
            data: new FormData(),
            pages: '',
            reportId: '',
            page: 'Pending'
        }
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.callAPI('get', '/admin/reports/data')
            .then((responce) => {
                this.afterRequest(responce);
            }).catch(error => {
                console.log(error);
                this.$Progress.fail();
            });
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
            document.getElementById('approved').style.display = 'none';
            this.page = 'Pending'
        },
        approved_button() {
            document.getElementById('pending').style.display = 'none';
            document.getElementById('approved').style.display = 'flex';
            this.page = 'Approved'

        },
        afterRequest(responce) {
            this.pending = responce.pending;
            this.approved = responce.approved;
            // this.from = responce.pending.from;
            // this.perPage = responce.pending.per_page;
            // this.next = responce.pending.next_page_url;
            // this.prev = responce.pending.prev_page_url;
            // this.to = responce.pending.to;
            // this.total = responce.pending.total;
            // this.pages = responce.pending.last_page;
        },
        showModal(modal, report) {
            this.$modal.show(modal);
            this.reportId = report;
        },
        getPath(imgSrc) {
            console.log(imgSrc);
            return '/storage/' + imgSrc;
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

        // Ideas API:
        approveReport(id) {
            this.$Progress.start();
            this.callAPI('post', `/admin/reports/${id}/update`)
                .then(() => this.callAPI('get', '/admin/reports/data')
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
        },
        deleteReport(id) {
            this.$Progress.start();
            this.callAPI('post', `/admin/reports/${id}/delete`)
                .then((responce) => this.$modal.hide("delete-report-modal"))
                .then(() => this.callAPI('get', '/admin/reports/data')
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
