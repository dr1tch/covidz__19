<template>
<div>
    <div class="main-wall-header flex justify-content-between align-item-center">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;">Ideas</h1>
        <!-- <div class="flex justify-content-center align-items-center ">
            <form action="/ideas/find" method="POST" @submit.prevent="categoryOrder" class="flex justify-content-center align-items-center ">
                <select name="" v-model="category" id="" class="form-control-sm bg-secondary text-light mr-2">
                    <option value="" selected="selected" disabled>Category...</option>
                    <option v-for="category in $store.state.categories" :key="category.id" :value="category.id">{{category.name}}</option>
                </select>
                <button type="submit" class="btn btn-sm btn-info font-weight-bold mr-2">
                    Show
                </button>
                
            </form>
            <div>
                <button @click='getData' class="btn btn-sm btn-success font-weight-bold">
                    ShowAll
                </button>
            </div>

        </div> -->
    </div>
    <div class="posts" v-if="$store.state.ideas.len">
        <div class="p-0 m-0" v-for="idea in $store.state.ideas" :key="idea.id">
  <div class="post flex">
        <div class="mr-3 mt-1 flex-shrink-0">
            <a :href="'/' + idea.user.username">
                <img class="img-md" style="margin: 10%; margin-left: 13%" :src="idea.user.avatar" alt="">
            </a>
        </div>
        <div style="width: -webkit-fill-available;">
            <div class="post-header">
                <div class="profile-link-right-side">
                    <div>
                        <a class="post-name text-light" :href="'/' + idea.user.username">
                            <h6 style="font-weight: bold; margin-bottom: 0;">{{ idea.user.fname + ' ' + idea.user.lname}}</h6>
                        </a>
                    </div>
                    <div class="ml-2">
                        <span class="text-secondary" style="font-size: .9em;"> {{ '@' + idea.user.username}}</span>
                    </div>
                    <div class="ml-3" v-if="route == 'Bookmarks'">
                        <span class="btn-sm btn-dark font-weight-bold border-0" v-text='idea.category.name'></span>
                    </div>
                </div>
                <!-- <div class="bookmark flex justify-content-end">
                <span class="btn-sm btn-dark font-weight-bold border-0" v-text="idea.category.name"></span>
            </div> -->
            </div>
            <div>
                <span class='ml-2' style="font-size: 0.9em; color: #999">{{ postedOn(idea) }}</span>
            </div>
            <a class="text-light" href="">
                <div class="post-body mr-4 mt-1">
                    <div class="text my-3">
                        <h4 class="text-success font-weight-bold" v-text="idea.title"></h4>
                    </div>
                    <div class="text">
                        <p v-text="idea.body"></p>
                    </div>
                    <div class="media">
                        <img class="post-media rounded-xl" v-if="exist(idea.image)" :src="getPath(idea.image)">
                    </div>
                </div>
            </a>
            
           
            </div>
        </div>
        </div> 
    </div>
    
    <div class="posts" v-else>
         <div>
                    <h2 class="alert text-center p-5 text-warning">NO IDEAS ADDED YET!!!!</h2>
        </div>
    </div>
</div>
</template>

<script>
export default {
     data() {
        return {
            csrf_token: window.csrf_token,
            data: {
                ideas: '',
                pubs: '',
                categories: '',
                wilayas: '',
                diseases: '',
                jobs: '',
            },
            form : new FormData(),
        }
    },
    mounted() {
         this.form.set('csrf_token', window.csrf_token)
        axios.post('/start', this.form)
            .then((response) => {
                // console.log(response.data);
                this.data = response.data;
                this.$store.commit('addGuest', this.data);
            }).catch((errors) => {
                console.log("errors: ",errors);
                this.$Progress.fail();
            });
    },
}
</script>

