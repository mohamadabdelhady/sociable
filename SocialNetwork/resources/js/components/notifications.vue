<template>

    <div class="dropdown">
        <button class="btn dropdown-toggle mr-3 mybtn userlogindrop" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/notifications_icon.png" class="userAvatar"></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <p class="dropdown-item-text">+</p>
        </div>
    </div>

</template>

<script>

export default {
    props:['myid'],

    mounted() {
        window.Echo.private("chat"+this.myid)
            .listen('MessageSend', (e) => {
                document.getElementById('dropdown-menu').innerHTML+="";

            });
    },
}
</script>

<style scoped>
@import "chat-box.css";
</style>
