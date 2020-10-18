<template>
<div>
    <div class="post">
        <div class="card-body">
            <div class="post-body mr-4 mt-1">
                <div class="media mb-3">
                    <img class="post-media rounded-xl" v-if="exist(pub.image)" :src="getPath(pub.image)">
                </div>
                <div class="flex justify-content-between align-items-top">
                    <div class="flex justify-content-start align-items-center">
                        <div class="text my-3">
                            <h4 class="text-success font-weight-bold " v-text="pub.title"></h4>
                        </div>
                        <div>
                            <span class='ml-2' style="font-size: 0.9em; color: #999">{{ postedOn(pub) }}</span>
                        </div>
                    </div>

                    <div v-if="$store.state.auth" class="flex justify-content-end align-items-top my-1">
                        <div v-if='!$store.state.isPubsBookmarked'>
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

                <div class="text mb-4">
                    <p v-text="pub.body"></p>
                    <a class="font-weight-bold" target="_blank" :href="pub.source">Read more</a>
                </div>
                <hr>
                <div>
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
            </div>
            <div class="card-footer flex btn-group justify-between react-container " v-if="$route.name == 'Publications' && $store.state.auth">
                <div class="full-heart">
                    <div class="flex">
                        <div v-if="!pub.liked || !clicked">
                            <button class="btn" type="button" @click="toggleLike">
                                <span class="react text-secondary red-hover"> <i id="empty-heart" class="far fa-heart"></i></span>
                            </button>
                        </div>
                        <div v-else>
                            <button class="btn" type="button" @click="toggleLike">
                                <span class="react text-danger red-hover"> <i id="empty-heart" class="fa fa-heart"></i></span>
                            </button>
                        </div>
                        <div class="react-count-container">
                            <span class="span-react text-secondary">
                                {{pub.users.length}}

                            </span>
                        </div>
                        <div class="border-left border-dark flex justify-content-start align-items-center">
                            <span class="mr-1 ml-2">liked by</span>
                            <span v-for="user in pub.users" :key="user.id" class="font-weight-bold mr-1 text-info text-sm" v-text=" ', ' + user.lname + ' ' +user.fname+'.'"></span>
                            <span></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
</template>

<style scoped>
.react-container {
    width: 100%;
}
</style>

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
            this.$emit('booked', true);
            this.$store.commit('pushPubsBookmark', this.pub);
            this.$store.commit('isBookedPubs', this.pub);
            this.bookmarked = this.$store.getters.isPubBookmarked;
            // this.$emit('booked', true);
            this.$Progress.finish();
        },
        clicked(){
            this.$store.commit('clicked', this.pub);
            return this.$store.state.isClicked;
        },
        toggleLike() {
            this.callAPI('post', `/like/${this.pub.id}/publication`)
                .then((responce) => {
                    let e = document.querySelector('#empty-heart');
                    if (e.classList.contains("far")) {
                        e.classList.remove("far");
                        e.classList.add("fa");
                    } else if (e.classList.contains("fa")) {
                        e.classList.remove("fa");
                        e.classList.add("far");
                    }
                })
                .then((responce) => {
                    this.$emit('liked', true);
                    let item = 0;
                    this.pub.users.map((user) => {
                        if (user.id == this.$store.state.user.id) {
                            return item;
                        } else {
                            item++;
                        }
                    });
                    if (item !== this.pub.users.length) {
                        this.pub.users.splice(item, 1);
                        // this.idea.likes--;
                    } else {
                        this.pub.users.push(this.$store.state.user);
                        // this.idea.likes++;
                    }
                    this.$store.commit('clicked', pub);
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        isBookmarked(){
            this.$emit('booked', true);
        },
        reacted(e) {
            if (e) {
                this.$emit('reload', true);
            }
        },
    },
}
</script>
