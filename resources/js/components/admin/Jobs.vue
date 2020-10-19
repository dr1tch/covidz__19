<template>
<div>
     <div class="card bg-card">
        <div class="card-header flex justify-content-between align-items-center">
            <h1 v-text="routeName"></h1>
            <button
                @click="$modal.show('add-category-modal')" 
                class=" btn btn-sm btn-outline-primary">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Add Profession
            </button>
        </div>
        <div class='table-responsive card-body' v-if="categories.length">
            <table id="my-table" class="table table-bordered">
                <thead class="text-success font-weight-bold">
                    <tr>
                        <th>ID</th>
                        <th>Profession Name</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in showCategories" :key="category.id" >
                        <td v-text="category.id"></td>
                        <td v-text="category.name"></td>
                        <td>{{ moment(category.created_at).format("DD-MM-YYYY") }}</td>
                        <td>
                            <div>
                                <button type="button"  @click.prevent="showModal('edit-category-modal',category)"  class="btn btn-sm btn-primary">Edit</button>
                                <button type="button" @click.prevent="showModal('delete-category-modal',category)" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                 </tbody>
            </table>
        </div>
        <h2 v-else class="alert text-center p-5 text-warning">NO PROFESSIONS ADDED YET!!!!</h2>
        <div class="card-footer" v-if="categories.length">
            <div class=" flex justify-content-between align-items-center">
                <div class="my-4">
                    <ul class="pagination pagination-md justify-content-center text-center">
                        <li  class="page-item"
                            :class="page === 1 ? 'disabled' : ''"
                        >
                            <a 
                                class="page-link" 
                                @click="prevPage" 
                            >
                                Previous
                            </a>
                        </li>
                        <li class="page-link" style="background-color: inherit"> 
                            {{ page }} of {{ lastPage }}
                        </li>
                        <li  class="page-item" 
                            :class="page === lastPage ? 'disabled' : ''"
                        >
                            <a class="page-link" 
                                @click="nextPage"
                            >
                                Next
                            </a>
                        </li>
                    </ul>
                </div>
                    <button type="button" @click.prevent="$modal.show('delete-categories-modal')" class="btn btn-sm btn-danger">Delete All</button>
                </div>
            </div>
        </div>
        <!-- Add Tag Modal -->
        <modal
            name="add-category-modal"
            height="auto"
            width="500px"
            classes="text-light bg-secondary"
        >
            <div>
            
                <div class="card bg-card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Add Profession</h4>
                    </div>
                    <form action="/addCategory" method="POST" @submit.prevent="addCategory" @keydown="form.errors.clear($event.target.name)">
                        <div class="card-body">
                            <div>
                                <input type="text" class=" form-control bg-secondary text-light" placeholder="Category Name.." v-model="form.catName">
                                <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.catName[0]"></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('add-tag-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success" :disabled="form.errors.any()">Add</button>
                            </div>
                        </div>
                     </form>
                </div>
           
            </div>
        </modal>
        <!-- Edit Tag Modal -->
        <modal
                name="edit-category-modal"
                height="auto"
                width="500px"
                classes="text-light bg-secondary"
            >
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Edit Profession</h4>
                    </div>
                    <form :action="`/editCategory/${editable.id}`" method="POST" @submit.prevent="editCategory" @keydown="form.errors.clear($event.target.name)">
                        <div class="card-body">
                            <div>
                                <input type="text" class=" form-control bg-secondary text-light" v-model="form.catName" placeholder="New Category Name..">
                                <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.catName[0]"></span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('edit-category-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success" :disabled="form.errors.any()">Edit</button>
                            </div>
                        </div>
                     </form>
                    
                </div>
        </modal>
        <!-- Delete Tag Modal -->
         <modal
                name="delete-category-modal"
                height="auto"
                width="500px"
                classes="text-light bg-secondary"
            >
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Delete Profession</h4>
                    </div>
                    <form :action="`/deleteCategory/${editable.id}`" method="POST" @submit.prevent="deleteCategory" @keydown="form.errors.clear($event.target.name)">
                        <div class="card-body">
                            <div>
                                <h5 class="alert font-size-lg m-auto text-center">Are You Sure!!</h5>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('delete-category-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Delete</button>
                            </div>
                        </div>
                     </form>
                    
                </div>
        </modal>

         <!-- Delete All Tag Modal -->
         <modal
                name="delete-categories-modal"
                height="auto"
                width="500px"
                classes="text-light bg-secondary"
            >
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Delete All Professions</h4>
                    </div>
                    <form action="/deleteAllCategories" method="POST" @submit.prevent="deleteAllCategories">
                        <div class="card-body">
                            <div>
                                <h5 class="alert font-size-lg m-auto text-center">Are You Sure!!</h5>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex align-items-center justify-content-between">
                                <button  type="button" @click="$modal.hide('delete-categories-modal')" class="btn btn-sm btn-danger" >Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Delete</button>
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
        margin-right:auto;
    }
    .vm--overlay {
        background: unset;
    }
    .vm--modal {
        box-shadow: unset;
    }
    ul {
        margin-bottom: 0;
    }
</style>

<script>
    
    import Form from '../../Form'
    import moment from 'moment'
    // import editModal from "../templates/editModal"
    export default {
        // components: { editModal },
        data() {
            return {
                form: new Form({
                    catName: '',
                }),
                categories: [],
                perPage: 4,
                currentPage: 1,
                editable: {
                    id: '',
                    catName: '',
                },
                page: 1,
                loading: false,
            }
        },
        mounted (){
            console.log(this.$route.name);
            this.getCategories();
            console.log(this.categories);
        },
        computed: {
            routeName (){
                return this.$route.name;
            },
            errors (){
                return Object.keys(this.form.errors.errors).length > 0;
            },
            rows() {
                return this.categories.length
            },
            showCategories () {
                let start = (this.page - 1) * this.perPage
                let end = start + this.perPage
                this.loading = false
                return this.categories.slice(start, end)
            },
            lastPage () {
                let length = this.categories.length 
                return Math.floor(length / this.perPage) + 1;
            },
            date(d){
                return moment(d).format("dddd, MMMM Do YYYY");
            }     
        },
       
        methods: {
            showModal(name, cat){
                this.form.catName = cat.name;
                let obj = {
                    id : cat.id, 
                    catName : cat.name
                }
                console.log("obj: " + obj);
			    this.editable = obj;
                this.$modal.show(name);
                console.log("blabla!" + this.editable.catName);
            },
            prevPage () {
                this.loading = true
                this.page--
            },
            nextPage () {
                this.loading = true
                this.page++
            },
            
            // API PART:

            getCategories() {
                this.callAPI('get', '/admin/jobs/get')
                            .then(responce => this.categories = responce);
            },
            addCategory() {
            this.form.post('/admin/jobs/create')
                .then(() => this.$modal.hide('add-category-modal'))
                .then(() => this.getCategories());
            },
             editCategory() {
                 console.log(this.editable.id);
                this.form.post(`/admin/jobs/${this.editable.id}/update`)
                    .then(() => this.$modal.hide('edit-category-modal'))
                    .then(() => this.getCategories());
             },
             deleteCategory() {
                 this.form.post(`/admin/jobs/${this.editable.id}/delete`)
                    .then(() => this.$modal.hide('delete-category-modal'))
                    .then(() => this.getCategories());
             },
             deleteAllCategories() {
                 this.form.post('/admin/jobs/deleteAll')
                    .then(() => this.$modal.hide('delete-categories-modal'))
                    .then(() => this.getCategories());
             }
            
        },
    }
</script>