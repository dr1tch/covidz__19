<template>
    <div>
        <Header :route ="route"></Header>
        <Posts :ideas = "ideas"></Posts>
    </div>
</template>

<style scoped>
    
</style>

<script>
import Header from './templates/header'
import Posts from './templates/Posts'
export default {
    data() {
        return {
            // users: [],
            ideas: [],
            cover: '',
            title: '',
            body: '',
            imgPreview: '',
            data: new FormData(),
        }
    },
    components: {
        Header,
        Posts,
    },
    mounted() {
        this.getData();
    },
    computed: {
        route() {
            return this.$route.name;
        }
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
                    this.ideas = response[0];
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
                            this.ideas = response[0];
                            console.log(response);
                        })
                })
                .then(() => {
                    this.$modal.hide("add-idea-modal")
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>
