<template>
<div>
    <div class="tab">
        <a href="#" id="notifications" class="me-4" v-on:click.prevent="change_selected('notifications')">Notifications</a>
        <a href="#" id="requests" v-on:click.prevent="change_selected('requests')">Requests</a>
        <hr>
    </div>
    <div id="notifications_area" style="display: none">
        <notification_home></notification_home>
    </div>
    <div id="requests_area" style="display: none">
        <request_home></request_home>
    </div>
</div>
</template>

<script>
export default {
    name: "notifications_menu",
    data(){
        return{
            selected:"notifications",
        }
    },
    methods:
        {
            change_selected(select)
            {
                this.selected=select;
            }
        },
    mounted() {

        document.getElementById(this.selected).style="border-bottom:3px solid #565c68";
        document.getElementById(this.selected+"_area").style="display:block";
    },
    watch: {
        selected: function (newVal, oldVal) {
            document.getElementById(oldVal).style = "border-bottom:none;";
            document.getElementById(oldVal+"_area").style = "display:none;";
            document.getElementById(newVal).style = "border-bottom:3px solid #565c68;";
            document.getElementById(newVal+"_area").style = "display:block;";
        }
    }
}
</script>

<style scoped>
.tab a{
    text-decoration: none;
    color:black;
}
.tab hr{
    margin-top: 0;
}
</style>
