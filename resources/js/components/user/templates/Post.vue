<template lang="">
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
            </div>
            <!-- <div class="bookmark flex justify-content-end">
                <span class="btn-sm btn-dark font-weight-bold border-0" v-text="idea.category.name"></span>
            </div> -->
            <div class="bookmark flex justify-content-end">
                <button type="button" class="btn btn-sm text-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                    </svg>
                </button>
                <div class="dropdown-menu dropdown-menu-right bg-dark text-light">
                    <button class="dropdown-item text-light" type="button" @click="toggleBookmark">
                        <span class="react text-light mr-2 " style="font-size: 1.15em"> <i id="empty-bookmark" class="far fa-bookmark"></i></span>
                        Add to Bookmarks
                    </button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item text-light center" type="button">Edit Idea</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item text-light" type="button">Delete Idea</button>
                </div>
            </div>

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
        <div class="flex btn-group justify-between react-container ">
            <div class="full-heart">
                <div class="flex">
                    <button class="btn" type="button">
                        <span class="react text-danger"> <i id="empty-heart" class="fa fa-heart"></i></span>
                    </button>

                    <div class="react-count-container">
                        <span class="text-secondary">
                            25
                        </span>
                    </div>
                </div>
            </div>
            <!-- <div>
                <button class="btn flex" type="button">
                    <div>
                        <span class="react text-primary"> <i id="empty-bookmark" class="fa fa-bookmark"></i></span>

                    </div>
                </button>
            </div> -->
        </div>
    </div>
</div>
</template>

<style scoped>
.bookmark {
    margin-right: 2%;
    width: 30%;
    justify-content: flex-end;
}
.dropdown-item:hover, .dropdown-item:focus, .dropdown-item:visited, .dropdown-item:active {
    color: inherit;
    border: none !important;
    text-decoration: none;
    background-color: inherit;
    outline: none;
}
</style>

<script>
import moment from 'moment'
import React from './React'
export default {
    data() {
        return {
            // user: {},
            data: new FormData(),
            isBookmarked: '',
        }
    },
    props: ["idea", 'user'],
    mounted() {
       
    },
    components: {
        React
    },
    computed: {

    },
    methods: {
        getPath(imgSrc) {
            console.log(imgSrc);
            return '/storage/' + imgSrc;
        },
        getProfile(imgPath) {
            return '/images' + imgPath;
        },
        postedOn(idea) {
            return moment(idea.created_at).fromNow();
        },
        exist(path) {
            return path !== null;
        },
        toggleBookmark(){
            this.$store.commit('pushBookmark', this.idea);
            this.data.set('_method', "patch");
            this.callAPI('post', `/bookmark/${this.idea.id}`, this.data)
                .then(() => {
                    let e = document.querySelector('#empty-bookmark');
                    if(e.classList.contains("far")){
                        e.classList.remove("far");
                        e.classList.add("fa");
                    } else if(e.classList.contains("fa")){
                        e.classList.remove("fa");
                        e.classList.add("far");
                    }
                
                })
                .catch((errors) => {
                    console.log(errors);
                });
        }
    },
}
</script>
