export default {
    data() {
        return {
            // perPage: 4,
            // curentPage: 1,
            // page: 1,
        }
    },
    computed: {
       
    },
    methods: {
        
        callAPI (method, url, data=null){
          return new Promise((resolve, reject) => {
            axios[method](url, data)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
          });
        },
        asset(path) {
            let base_path = window.asset || '';
            console.log(base_path);
            return base_path + 'storage/' + path;
        },
        nextPage() {
            this.$Progress.start();
            this.callAPI('get', this.next)
                .then(
                    (responce) => {
                       this.afterRequest(responce);
                    })
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        previousPage() {
            this.$Progress.start();
            this.callAPI('get', this.prev)
                .then(
                    (responce) => {
                        this.afterRequest(responce);
                    })
                .catch(error => {
                    console.log(error);
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        clear(field) {
            if (field) {
                delete this.errors[field];
    
                return;
            }
    
            this.errors = {};
        },
        any(errors){
            return Object.keys(errors).length > 0;
        },
        // start () {
        //     this.$Progress.start()
        // },
        // finish () {
        //     this.$Progress.finish()
        // },
        // fail () {
        //     this.$Progress.fail()
        // },
        // showObjs(objs) {
        //     let start = (this.page - 1) * this.perPage
        //     let end = start + this.perPage
        //     this.loading = false
        //     return objs.slice(start, end)
        // },
        // lastPage(objs) {
        //     let length = objs.length
        //     return Math.floor(length / this.perPage) + 1;
        // },
        // prevPage() {
        //     this.loading = true
        //     this.page--
        // },
        // nextPage() {
        //     this.loading = true
        //     this.page++
        // },
    },
}

 // async created() {
        //     const res = await this.callAPI('post', '/addTag', {tagName: 'test'});
        //     console.log(res);
        //     if(status == 200){
        //         console.log(res);
        //     }
        // },