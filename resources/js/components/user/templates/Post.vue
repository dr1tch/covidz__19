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
            <div class="bookmark">
						<button class="btn flex" type="button">
							<div>
								<span class="react text-primary"> <i id="empty-bookmark" class="fa fa-bookmark"></i></span>

							</div>
						</button>
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
				</div>
    </div>
</div>
</template>

<script>
import moment from 'moment'
import React from './React'
export default {
    data() {
        return {
            // user: {},
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
        getProfile(imgPath){
            return '/images' + imgPath;
        },
        postedOn(idea) {
            return moment(idea.created_at).fromNow();
        },
         exist(path){
            return path !== null;
        }
    },
}
</script>
