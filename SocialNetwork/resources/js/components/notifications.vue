<template>

    <div class="dropdown">
        <button class="btn dropdown-toggle mr-3 mybtn userlogindrop" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/notifications_icon.png" class="userAvatar"></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="noti-menu">

        </div>
    </div>

</template>

<script>

export default {
    props:['myid'],

    mounted() {
        window.Echo.private("notification"+this.myid)
            .listen('notification', (e) => {
                let message=e.message
                document.getElementById('noti-menu').innerHTML+="<p className='dropdown-item'>"+message+"</p>";

            });
    },
}
</script>

<style scoped>
@import "chat-box.css";
</style>
