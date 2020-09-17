<template>
<div>
    <button type="button" @click="$modal.show('add-idea-modal')" class="btn btn-lg btn-success"> Add Idea</button>
    <!-- Add Ideas Modal -->
    <modal name="add-idea-modal" height="auto" width="500px" classes="text-light bg-secondary">
        <div>

            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold">Add Idea</h4>
                </div>
                <form action="/ideas/create" method="POST" @submit.prevent="addIdea">
                    <div class="card-body">
                        <div>
                            <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Title ..." v-model="title">
                            <!-- <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span> -->
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
                            <img :src="imgPreview" alt="" class="img-preview img-fluid rounded-lg">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex align-items-center justify-content-between">
                            <button type="button" @click="$modal.hide('add-idea-modal')" class="btn btn-sm btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Add</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </modal>
</div>
</template>

<style scoped>
    
</style>

<script>
export default {
    data() {
        return {
            ideas: [],
            cover: '',
            title: '',
            body: '',
            imgPreview: '',
            data: new FormData(),
        }
    },
    mounted() {

    },
    computed: {

    },
    methods: {

        newCover(event) {
            let files = event.target.files;
            console.log("file: " + files[0]);
            if (files.length) this.cover = files[0];
            console.log(this.cover)
            this.imgPreview = URL.createObjectURL(event.target.files[0]);
        },




        // Ideas APIs
        getData() {
            this.callAPI('get', '/ideas/data')
                .then((response) => {
                    console.log(response);
                    this.ideas = response;
                })
        },
        addIdea(){
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
                            this.ideas = response;
                            console.log(response);
                        })
                }).catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>
