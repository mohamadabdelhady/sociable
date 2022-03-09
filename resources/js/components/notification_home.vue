<template>
    <div class="wrapper">
       <p class="noti">NOTIFICATIONS<span class="result-num">{{notifications_num}}</span></p>
        <div class="card mb-2 me-2" v-for="(notification, index) in notifications">
            <a style="font-family:Arial, FontAwesome" href="#" class="close rm_text_decoration" v-on:click.prevent="rm_notification">&#xf00d</a>
            <p>{{notification}}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "notification_home",
    props:['id'],
    data()
    {
        return{

            notifications:[],
            notifications_num:0,
        }
    },
    methods:{
        rm_notification()
        {
            console.log('close')
        }


    },
    mounted() {
        Echo.private('notifications.'+this.id)
        .listen('RealTimeNotification',(event)=>{
            let message=event.message;
            console.log(message);
            this.notifications_num++;
            this.notifications.unshift(message);
        })
    }
}
</script>

<style scoped>
.noti{
    color: grey;
    font-weight: bold;
}
.wrapper{
   height: 200px;
    overflow-x: auto;
    overflow-x:hidden;
}
.close{
    text-align: right;
}
</style>
