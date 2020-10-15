<template>
<div class="flex btn-group justify-between react-container ">
    <div class="full-heart">
        <div class="flex">
            <div v-if="!idea.liked">
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
                    {{idea.users.length}}

                </span>
            </div>
			<div class="border-left border-dark flex justify-content-start align-items-center" v-if="idea.users.length > 0">
				<span class="mr-1 ml-2">liked by</span>
				<span v-for="user in idea.users" :key="user.id" class="font-weight-bold mr-1 text-info text-sm" v-text=" ' ' + user.lname + ' ' +user.fname+', '"></span>
			<span></span>
			</div>
        </div>
    </div>

</div>
</template>

<script>
export default {
	data() {
		return {
			isClicked: '',
			data: new FormData(),
			likers: [],
		}
	},
	mounted() {
		console.log(this.idea.users.includes(this.$store.getters.user));
		console.log(this.$store.getters.user.id);
		// this.isClicked = this.idea.users.includes(this.$store.state.user);
		// console.log(`isClicked: ${this.liked}`);
	},
	props: ['idea', 'liked'],
    methods: {
        toggleLike(){
			this.data.set('_method', "patch");
			this.callAPI('post', `/like/${this.idea.id}`, this.data)
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
					this.idea.users.map((user) => {
						if(user.id == this.$store.state.user.id){
							return item;
						} else {
							item++;
						}
					});
					 if(item !== this.idea.users.length){
						this.idea.users.splice(item, 1);
						// this.idea.likes--;
					} else {
						this.idea.users.push(this.$store.state.user);
						// this.idea.likes++;
					}
				})
				.catch((error) => {console.log(error)});
		},
		// isClicked(){
		// 	console.log(this.idea.users.includes(this.$store.state.user));
		// 	 this.idea.users.includes(this.$store.state.user);
		// }
    }
}
</script>
