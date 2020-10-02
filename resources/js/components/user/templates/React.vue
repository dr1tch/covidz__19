<template>
	<div class="flex btn-group justify-between react-container ">				
					<div class="full-heart">
						<div class="flex">
							<button class="btn" type="button">
                                <span class="react text-secondary red-hover"> <i id="empty-heart" class="far fa-heart"></i></span>
							</button>
							
							<div class="react-count-container">
								<span class="span-react text-secondary">
									25
								</span>
							</div>
						</div>				
					</div>
					<!-- <div class="reply">
						<div class="flex">
							<button id="reply" class="btn" type="button" @click="rectiontest">
								<span class="react text-secondary green-hover"> <i id="empty-comment" class="far fa-comment-alt"></i></span>
							</button>
							
							<div class="react-count-container">
								<span class="span-react text-secondary">
									25
								</span>
							</div>
						</div>
					</div>
					<div class="share">
						<div class="flex">
							<button class="btn" type="button">
								<span class="react text-secondary cyan-hover"> <i id="empty-comment" class="fas fa-share-alt"></i></span>

							</button>
							
							<div class="react-count-container">
								<span class="span-react text-secondary">
									25
								</span>
							</div>
						</div>
					</div> -->
					<div class="bookmark">
						<button class="btn flex" type="button">
							<div>
								<span class="react text-secondary red-hover"> <i id="empty-bookmark" class="far fa-bookmark"></i></span>

							</div>
						</button>
					</div>
				</div>
</template>

<script>
	
	export default {
		methods: {
			rectiontest(){
				alert("success!")
			}
		}
	}
</script>