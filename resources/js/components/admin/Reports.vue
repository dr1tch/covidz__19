<template>
<div>
    <div class="card bg-card">
        <div class="card-header">
            <h1 v-text="routeName"></h1>
        </div>
        <div class='table-responsive card-body'>
            <table class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th class="hidden-sm">Title</th>
                        <th>Body</th>
                        <!-- <th class="hidden-md">Reporter Profile</th> -->
                        <th>Cover</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in pending" :key="report.id">
                        <td v-text="report.id"></td>
                        <td class="hidden-sm" v-text="report.title"></td>
                        <td v-text="report.body.substr(0, 20) + '....'"></td>
                        <td class="hidden-md">
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="report.image" alt="">
                            </a>
                        </td>
                        <td><span class="btn-sm btn-warning font-weight-bold border-0" v-text="report.category.name"></span></td>
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

        <div class="card-footer">
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
        </div>
    </div>
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
        afterRequest(responce) {
            this.pending = responce.pending.data;
            this.currentPage = responce.pending.current_page;
            this.from = responce.pending.from;
            this.perPage = responce.pending.per_page;
            this.next = responce.pending.next_page_url;
            this.prev = responce.pending.prev_page_url;
            this.to = responce.pending.to;
            this.total = responce.pending.total;
            this.pages = responce.pending.last_page;
        },
        showModal(modal, report) {
            this.$modal.show(modal);
            this.reportId = report;
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
