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
                        <th class="hidden-sm">Full Name</th>
                        <th>Username</th>
                        <th class="hidden-md">E-Mail</th>
                        <th>Role</th>
                        <th>Profile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td v-text="user.id"></td>
                        <td class="hidden-sm">{{user.fname + ' ' + user.lname}}</td>
                        <td v-text="user.username"></td>
                        <td class="hidden-md" v-text="user.email"></td>
                        <td v-if="user.role"><span class="btn btn-sm btn-danger font-weight-bold py-2 px-3 border-0">admin</span></td>
                        <td v-if="!user.role"><span class="btn btn-sm btn-success font-weight-bold py-2 px-3 border-0">user</span></td>
                        <td>
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" :src="user.avatar" alt="">
                            </a>
                        </td>
                        <td>
                            <div>
                                <button @click.prevent="showModal('edit-user-modal',user)" type="button" class="btn btn-sm btn-primary">Edit</button>
                                <button @click.prevent="showModal('delete-user-modal',user)" type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <h2 v-else class="alert text-center p-5 text-warning">NO ALBUMS ADDED YET!!!!</h2> -->
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
                <button type="button" @click.prevent="$modal.show('delete-userss-modal')" class="btn btn-sm btn-danger">Delete All</button>
            </div>
        </div>
    </div>

    <!-- Edit Tag Modal -->
    <modal name="edit-user-modal" height="auto" width="500px" classes="text-light bg-secondary">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">Edit User</h4>
            </div>
            <form :action="`/admin/users/${editedUser.id}/update`" method="POST" @submit.prevent="editUser(editedUser.id)">
                <div class="card-body">
                    <div>
                        <select class="custom-select bg-secondary" name="role" id="role" v-model="role" required>
                            <option value="0" selected>User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="flex align-items-center justify-content-between">
                        <button type="button" @click="$modal.hide('edit-user-modal')" class="btn btn-sm btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success">Edit</button>
                    </div>
                </div>
            </form>

        </div>
    </modal>

    <!-- Delete User Modal -->

    <modal name="delete-user-modal" height="auto" width="500px" classes="text-light bg-secondary">
        <div class="card">
            <!-- <div class="card-header">
                        <h4 class="font-weight-bold">Delete </h4>
                    </div> -->
            <form :action="`/users/${editedUser.id}/delete`" method="POST" @submit.prevent="deleteUser">
                <div class="card-body">
                    <div>
                        <h5 class="alert font-size-lg m-auto text-center">Are You Sure you want to delete <span class="font-weight-bold text-warning">{{'@'+editedUser.username}}</span> ?</h5>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="flex align-items-center justify-content-between">
                        <button type="button" @click="$modal.hide('delete-user-modal')" class="btn btn-sm btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success">Delete</button>
                    </div>
                </div>
            </form>

        </div>
    </modal>

    <!-- Delete All Albums Modal -->

    <modal name="delete-users-modal" height="auto" width="500px" classes="text-light bg-secondary">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">Delete All Userss</h4>
            </div>
            <form action="/admin/users/deleteAll" method="POST" @submit.prevent="deleteAllUsers">
                <div class="card-body">
                    <div>
                        <h5 class="alert font-size-lg m-auto text-center">Are You Sure!!</h5>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="flex align-items-center justify-content-between">
                        <button type="button" @click="$modal.hide('delete-Users-modal')" class="btn btn-sm btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success">Delete All</button>
                    </div>
                </div>
            </form>

        </div>
    </modal>

</div>
</template>

<style scoped>
.main-wall {
    border: none;
    max-width: auto;
    margin-right: auto;

}
</style>

<script>
import {
    mapGetters
} from 'vuex'
export default {
    data() {
        return {
            users: [],
            auth: '',
            editedUser: {},
            data: new FormData(),
            role: '',
            fresh: {},
            perPage: 4,
            currentPage: '',
            page: 1,
            from: '',
            to: '',
            next: '',
            prev: '',
            total: '',
            pages: '',
        }
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        console.log(this.$route.name);
        this.callAPI('get', '/admin/users/data')
            .then((responce) => {
                this.afterRequest(responce);
            })
            .catch(error => {
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
        showModal(name, user = this.editedUser) {
            this.editedUser = user;
            this.$modal.show(name);
        },
        afterRequest(data) {
            this.role = '';
            this.editedUser = {};
            // this.users = data.users;
            this.users = data.data;
            this.currentPage = data.current_page;
            this.from = data.from;
            this.perPage = data.per_page;
            this.next = data.next_page_url;
            this.prev = data.prev_page_url;
            this.to = data.to;
            this.total = data.total;
            this.pages = data.last_page;
        },
        // Users APIs:
        editUser(id) {
            this.$Progress.start();
            this.data.set('role', this.role);
            console.log(this.role);
            axios.post(`/admin/users/${id}/update`, this.data)
                .then(response => {
                    this.$modal.hide('edit-user-modal')
                })
                .then(() => this.callAPI('get', `/admin/users/data?page=${this.currentPage}`)
                    .then((responce) => {
                        this.users = responce.users;
                        this.afterRequest(responce);
                    }))
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        deleteUser() {
            this.$Progress.start();
            this.callAPI('post', `/admin/users/${this.editedUser.id}/delete`)
                .then(response => {
                    this.$modal.hide('delete-user-modal')
                })
                .then(() => this.callAPI('get', '/admin/users/data')
                    .then((response) => {
                        console.log('Axios; ', response);
                        this.users = response.users;
                        console.log('users: ', this.users);
                        this.afterRequest(response);
                    }))
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        deleteAllUsers() {
            this.$Progress.start();
            this.callAPI('post', '/admin/users/deleteAll')
                .then(response => {
                    this.$modal.hide('delete-users-modal')
                })
                .then(() => axios.get('/data')
                    .then((response) => {
                        // console.log(response.data);
                        this.users = response.data.users;
                        this.afterRequest(response.data);
                    }))
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        }
    },
}
</script>
