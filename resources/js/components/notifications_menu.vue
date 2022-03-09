<template>
<div>
    <div class="tab">
        <a href="#" v-on:click.prevent="change_selected('ebook_results')">Notifications</a>
        <a href="#" v-on:click.prevent="change_selected('audiobooks_results')"> <span id="audiobooks_results" class="ml-3">Audio books ({{audio.length}})</span></a>
        <hr>
    </div>
</div>
</template>

<script>
export default {
    name: "notifications_menu"
}
</script>

<style scoped>

</style>
