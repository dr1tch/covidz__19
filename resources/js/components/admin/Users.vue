<template>
<div>
    <div class="card bg-card">
        <div class="card-header">
            <h1 v-text="routeName"></h1>
        </div>
        <div class='table-responsive card-body'>
            <table class="table table-bordered" v-if="!arrayLength">
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
                    <tr v-for="user in showUsers" :key="user.id">
                        <td v-text="user.id"></td>
                        <td class="hidden-sm">{{user.fname + ' ' + user.lname}}</td>
                        <td v-text="user.username"></td>
                        <td class="hidden-md" v-text="user.email"></td>
                        <td v-if="user.role"><span class="btn btn-sm btn-danger font-weight-bold py-2 px-3 border-0">admin</span></td>
                        <td v-if="!user.role"><span class="btn btn-sm btn-success font-weight-bold py-2 px-3 border-0">user</span></td>
                        <td>
                            <a href="" data-toggle="tooltip" data-placement="bottom" title="View profile">
                                <img class="avatar" src="/images/profile.jpg" alt="">
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
            <h2 v-else class="alert text-center p-5 text-warning">NO ALBUMS ADDED YET!!!!</h2>
        </div>

        <div class="card-footer" v-if="!arrayLength">
            <div class=" flex justify-content-between align-items-center">
                <div class="my-4">
                    <ul class="pagination pagination-md justify-content-center text-center">
                        <li class="page-item" :class="page === 1 ? 'disabled' : ''">
                            <a class="page-link" @click="prevPage">
                                Previous
                            </a>
                        </li>
                        <li class="page-link" style="background-color: inherit">
                            {{ page }} of {{ lastPage }}
                        </li>
                        <li class="page-item" :class="page === lastPage ? 'disabled' : ''">
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
            <form :action="`/admin/users/${editedUser.id}/update`" method="POST" @submit.prevent="editUser">
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
    max-width: 100%;
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
            currentPage: 1,
            page: 1,
        }
    },
    mounted() {
        console.log(this.$route.name);
        axios.get('/admin/data')
                    .then((response) => {
                        // console.log(response.data);
                        this.users = response.data.users;
                    })
                .catch(error => console.log(error));
    },
    computed: {
        routeName() {
            return this.$route.name;
        },
        arrayLength() {
            console.log(this.$store.commit('length') > 0);
            return this.$store.commit('length') > 0;
        },
        showUsers() {
            let start = (this.page - 1) * this.perPage
            let end = start + this.perPage
            this.loading = false
            return this.users.slice(start, end)
        },
        lastPage() {
            let length = this.$store.commit('length');
            return Math.floor(length / this.perPage) + 1;
        },
    },
    methods: {
        showModal(name, user = this.editedUser) {
            this.editedUser = user;
            this.$modal.show(name);
        },
        afterRequest(data) {
            this.fresh = data;
            this.$store.commit('addData', this.fresh);
            this.$store.commit('removeAdmin');
            this.role = '';
            this.editedUser = {};
            this.users = data.users;
        },
        prevPage() {
            this.loading = true
            this.page--
        },
        nextPage() {
            this.loading = true
            this.page++
        },

        // Users APIs:
        editUser() {
            this.data.set('role', this.role);
            console.log(this.role);
            axios.post(`/admin/users/${this.editedUser.id}/update`, this.data)
                .then(response => {
                    this.$modal.hide('edit-user-modal')
                })
                .then(() => axios.get('/admin/data')
                    .then((response) => {
                        console.log('kjdlkqjljd' +response.data.users);
                        this.users = response.data.users;
                        this.afterRequest(response.data);
                    }))
                .catch(error => console.log(error));
        },
        deleteUser() {
            this.callAPI('post', `/admin/users/${this.editedUser.id}/delete`)
                .then(response => {
                    this.$modal.hide('delete-user-modal')
                })
                .then(() => axios.get('/admin/data')
                    .then((response) => {
                        // console.log(response.data);
                        this.users = response.data.users;
                        this.afterRequest(response.data);
                    }))
                .catch(error => console.log(error));
        },
        deleteAllUsers(){
            this.callAPI('post','/admin/users/deleteAll')
            .then(response => {
                    this.$modal.hide('delete-users-modal')
                })
            .then(() => axios.get('/admin/data')
                    .then((response) => {
                        // console.log(response.data);
                        this.users = response.data.users;
                        this.afterRequest(response.data);
                    }))
                .catch(error => console.log(error));
        }
    },
}
</script>
