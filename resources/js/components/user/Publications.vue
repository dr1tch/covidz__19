<template>
    <div>
         <div class="main-wall-header flex justify-content-between align-item-center">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="$route.name"></h1>
        
                <!-- <button @click='getData' class="btn btn-sm btn-success font-weight-bold"> -->
                    <!-- ShowAll -->
                <!-- </button> -->
            </div>
            <PubTimeline :pubs='publications'></PubTimeline>
    </div>
</template>

<style scoped>
    .main-wall-header {
        right: 0;
        max-width: 100%;
    }
    .main-wall {
        margin-right: 0 !important;
        max-width: 100% !important;
    }
</style>

<script>
import PubTimeline from './templates/PubTimeline'
export default {
    data() {
        return {
            publications: '',
        }
    },
    components: {
        PubTimeline,
    },  
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.callAPI('get', 'publications/data')
            .then((responce) => {
                console.log(responce);
                this.publications = responce;
            }).catch(error => {
                console.log(error);
                this.$Progress.fail();
            });
            this.$Progress.finish();
    },
}
</script>