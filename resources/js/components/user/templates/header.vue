<template lang="">
      <div class="main-wall-header flex justify-content-between align-item-center">
        <h1 class="mb-0" style="font-weight: bold;,letter-spacing: 3px;" v-text="route"></h1>
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