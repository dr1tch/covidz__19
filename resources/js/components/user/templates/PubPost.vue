<template>
<div>
    <div class="post">
        <div class="card-body">
            <div class="post-body mr-4 mt-1">
                <div class="media">
                    <img class="post-media rounded-xl" v-if="exist(pub.image)" :src="getPath(pub.image)">
                </div>
                <div class="flex justify-content-between align-items-top">
                    <div style="width:70%;">
                        <div>
                            <div class="my-2">
                                <span class="font-weight-bold">Wilayas: </span>
                                <span class="btn btn-sm btn-secondary mx-1 my-1 font-weight-bold" v-for="wilaya in pub.wilayas" :key="wilaya.id" v-text="wilaya.name"></span>
                            </div>
                        </div>
                        <div>
                            <div class="my-2">
                                <span class="font-weight-bold">Maladies: </span>
                                <span class="btn btn-sm btn-warning mx-1 my-1 font-weight-bold" v-for="disease in pub.diseases" :key="disease.id" v-text="disease.name"></span>
                            </div>
                        </div>
                        <div>
                            <div class="my-2">
                                <span class="font-weight-bold">Professions: </span>
                                <span class="btn btn-sm btn-info mx-1 my-1 font-weight-bold" v-for="job in pub.jobs" :key="job.id" v-text="job.name"></span>
                            </div>
                        </div>
                    </div>
                    <div style="width:30%; height: fit-content" class="flex justify-content-end align-items-top my-1">
                         <div v-if='!bookmarked'>
                            <button class="btn btn-sm btn-light flex font-weight-bold my-1" type="button" @click="toggleBookmark">
                                <span class="react text-dark mr-2 " style="font-size: 1.15em"> <i id="empty-bookmark" class="far fa-bookmark"></i></span>
                                Save to Bookmarks
                            </button>
                        </div>
                        <div v-else>
                            <button class="btn btn-sm btn-light flex font-weight-bold my-1" type="button" @click="toggleBookmark">
                                <span class="react text-dark mr-2 " style="font-size: 1.15em"> <i id="empty-bookmark" class="fa fa-bookmark"></i></span>
                                Saved
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-content-start align-items-center">
                    <div class="text my-3">
                        <h4 class="text-success font-weight-bold " v-text="pub.title"></h4>
                    </div>
                    <div>
                        <span class='ml-2' style="font-size: 0.9em; color: #999">{{ postedOn(pub) }}</span>
                    </div>
                </div>
                <div class="text">
                    <p v-text="pub.body"></p>
                </div>
            </div>
            <div class="card-footer flex btn-group justify-between react-container ">
                <div class="full-heart">
                    <div class="flex">
                        <div>
                            <button class="btn" type="button" >
                                <span class="react text-secondary red-hover"> <i id="empty-heart" class="far fa-heart"></i></span>
                            </button>
                        </div>
                        <div>
                            <button class="btn" type="button" >
                                <span class="react text-danger red-hover"> <i id="empty-heart" class="fa fa-heart"></i></span>
                            </button>
                        </div>
                        <div class="react-count-container">
                            <span class="span-react text-secondary">
                                <!-- {{idea.users.length}} -->

                            </span>
                        </div>
                        <div class="border-left border-dark flex justify-content-start align-items-center">
                            <span class="mr-1 ml-2">liked by</span>
                            <!-- <span v-for="user in idea.users" :key="user.id" class="font-weight-bold mr-1 text-info text-sm" v-text=" ', ' + user.lname + ' ' +user.fname+'.'"></span> -->
                            <span></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment'
export default {
    data() {
        return {
            data: new FormData(),
            bookmarked: '',
        }
    },
    props: ["pub"],
    beforeMount() {
        // this.$Progress.start();
    },
    mounted() {
        // this.$Progress.finish();
        this.$store.commit('isBookedPubs', this.pub);
        this.bookmarked = this.$store.getters.isPubBookmarked;
    },
    methods: {
        getPath(imgSrc) {
            console.log(imgSrc);
            return '/storage/' + imgSrc;
        },
        exist(path) {
            return path !== null;
        },
        postedOn(idea) {
            return moment(idea.created_at).fromNow();
        },

        toggleBookmark() {
            this.$Progress.start();
            this.data.set('_method', "patch");
            this.callAPI('post', `/bookmark/${this.pub.id}/publication`, this.data)
                .then(() => {
                    let e = document.querySelector('#empty-bookmark');
                    if (e.classList.contains("far")) {
                        e.classList.remove("far");
                        e.classList.add("fa");
                    } else if (e.classList.contains("fa")) {
                        e.classList.remove("fa");
                        e.classList.add("far");
                    }
                })
                .catch((errors) => {
                    console.log(errors);
                    this.$Progress.fail();
                });
            this.$store.commit('pushPubsBookmark', this.pub);
            this.$store.commit('isBookedPubs', this.pub);
            this.bookmarked = this.$store.getters.isPubBookmarked;
            this.$Progress.finish();
        },
        reacted(e){
            if(e){
                this.$emit('reload', true);
            }
        },
    },
}
</script>
