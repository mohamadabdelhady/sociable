<template>
    <div>
       <p class="noti">NOTIFICATIONS<span class="result-num">{{notifications_num}}</span></p>
        <div class="card notification-area" v-for="(notification, index) in notifications">

        </div>
    </div>
</template>

<script>
export default {
    name: "notification_home",
    data()
    {
        return{
            notifications:[],
            notifications_num:0,
        }
    },
    methods:{


    },
    mounted() {
        Echo.private('notifications')
        .listen('RealTimeNotification',(event)=>{
            let message=event.message;
            console.log("message");
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
.notification-area{
    height: 200px;
}
</style>
