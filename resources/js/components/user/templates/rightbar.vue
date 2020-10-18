<template lang="">
<div class="fixed-right">
    <div id="settings" class="card bg-card m-4 shadow d-block">
        <form action="/ideas/find" method="POST" @submit.prevent="search">
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

            <div class="d-flex justify-content-around align-items-center pb-4">
                <button type="submit" class="btn btn-sm btn-info font-weight-bold mr-2">
                    Search
                </button>
                <button @click='' class="btn btn-sm btn-success font-weight-bold">
                    ShowAll
                </button>
            </div>
        </form>

    </div>
</div>
</template>

<style scoped>
select {
    width: 250px;
    margin: auto;
    display: block;
}

.fixed-right {
    z-index: 99999;
}
</style>

<script>
export default {
    data() {
        return {
            wilaya: '',
            job: '',
            disease: '',
        }
    },

    methods: {
        search(){
            
        }
    }
}
</script>
