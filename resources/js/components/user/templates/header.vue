<template lang="">
        <div class="main-wall-header flex justify-content-between align-item-center">
			<h1 style="font-weight: bold;,letter-spacing: 3px;" v-text="route"></h1>
			<!-- <button :click="false" class="btn humburger" style="display; none;">
				<svg viewBox="0 0 100 80" width="1.5em" height="1.5em" fill="currentColor">
				    <rect width="100" height="20" rx="8"></rect>
				    <rect y="30" width="100" height="20" rx="8"></rect>
				    <rect y="60" width="100" height="20" rx="8"></rect>
				</svg>
			</button> -->
		</div>
</template>

<style scoped>
    .main-wall-header {
        border: 1px #eee solid;
        border-top: none;
        right: 349px;
        left: 274px;
    }
</style>

<script>
export default {
    props: ["route"],
}
</script>