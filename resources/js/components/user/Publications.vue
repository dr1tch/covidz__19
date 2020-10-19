<template>
<div>

    <div class="main-wall-header flex justify-content-between align-item-center">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1>
    </div>
    <PubTimeline :pubs='publications' :len="publications.length" @edited='updateData'></PubTimeline>
    <div class="fixed-right">
        <div id="settings" class="card bg-card m-4 shadow d-block">
            <form action="/ideas/find" method="POST" @submit.prevent="order">
                <select name="" v-model="wilaya" id="" class="form-control-sm bg-secondary text-light my-4">
                    <option value="" selected="selected" disabled>Wilaya...</option>
                    <option v-for="category in $store.state.wilayas" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>
                <select name="" v-model="job" id="" class="form-control-sm bg-secondary text-light my-4">
                    <option value="" selected="selected" disabled>Profession...</option>
                    <option v-for="category in $store.state.jobs" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>
                <select name="" v-model="disease" id="" class="form-control-sm bg-secondary text-light my-4">
                    <option value="" selected="selected" disabled>Maladie...</option>
                    <option v-for="category in $store.state.diseases" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>

                <div class="d-flex justify-content-start align-items-bottom pl-4">
                    <button type="submit" class="btn btn-sm btn-info font-weight-bold mr-2">
                        Search
                    </button>
                </div>
            </form>
            <div class="flex justify-content-end align-items-top pr-4 pb-4" style="margin-top: -9.5%">
                <button @click='getAll' class="btn btn-sm btn-success font-weight-bold">
                    ShowAll
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>
/* .main-wall-header {
    right: 0;
    max-width: 100%;
} */

select {
    width: 250px;
    margin: auto;
    display: block;
}

/*
.main-wall {
    margin-right: 0 !important;
    max-width: 100% !important;
} */
</style>

<script>
import PubTimeline from './templates/PubTimeline'
import UserRightbar from './templates/rightbar'

export default {
    data() {
        return {
            publications: '',
            filtred: '',
            user: '',
            wilaya: '',
            job: '',
            disease: '',
            data: new FormData(),
        }
    },
    components: {
        PubTimeline,
        UserRightbar
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
       
        this.getData();
        this.$Progress.finish();
        
    },
    methods: {
        updateData(e){
            console.log('heeeeeeeeeey',e);
            this.publications = e.pubs;
        },
        getData() {
            this.$Progress.start();
            this.callAPI('get', '/publications/data')
                .then((responce) => {
                    console.log(responce);
                    this.publications = responce.pubs;
                    this.user = responce.user;
                }).catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.filter();
            this.$Progress.finish();
            
        },
        getAll(){
             this.$Progress.start();
            this.callAPI('get', '/publications/data/all')
                .then((responce) => {
                    console.log(responce);
                    this.publications = responce.pubs;
                    this.user = responce.user;
                }).catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.filter();
            this.$Progress.finish();
        },
        filter() {
            Object.keys(this.publications).forEach(element => {
                element.wilayas.forEach(e => {
                    if (this.user.wilaya_id == e.id) {
                        this.filtred.push(element)
                    }
                });
                element.diseases.forEach(e => {
                    if (this.user.disease_id == e.id) {
                        this.filtred.push(element)
                    }
                });
                element.jobs.forEach(e => {
                    if (this.user.job_id == e.id) {
                        this.filtred.push(element)
                    }
                });
            });
        },
        order() {
            this.$Progress.start();
            this.data.set('wilaya', this.wilaya);
            this.data.set('job', this.job);
            this.data.set('disease', this.disease);
            this.callAPI('post', '/publications/find', this.data)
                .then((responce) => {
                    console.log(responce);
                    this.publications = responce
                }).catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            Object.keys(this.publications).forEach(element => {
                Object.keys(element.wilayas).forEach(e => {
                    if (this.user.wilaya_id == e.id) {
                        this.filtred.push(element)
                    }
                });
                Object.keys(element.diseases).forEach(e => {
                    if (this.user.disease_id == e.id) {
                        this.filtred.push(element)
                    }
                });
                Object.keys(element.jobs).forEach(e => {
                    if (this.user.job_id == e.id) {
                        this.filtred.push(element)
                    }
                });
            });
            this.$Progress.finish();
        }
    },
}
</script>
