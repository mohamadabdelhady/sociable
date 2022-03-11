<template>
    <div class="wrapper mt-4">
       <p class="noti">NOTIFICATIONS<span class="result-num">{{notifications.length}}</span></p>
        <div class="card mb-2 me-2" v-for="(notification, index) in notifications">
            <div class="close"><a style="font-family:Arial, FontAwesome" href="#" class="rm_text_decoration" v-on:click.prevent="rm_notification(notification.receiver)">&#xf00d</a></div>
            <p>{{notification.message}}</p>
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
        }
    },
    methods:{
        rm_notification(id)
        {
            axios.get('remove_notification/'+id)
                .then((res) => {
                    let self=this.notifications;
                    this.notifications.forEach(function(notification, index,self){
                        if(notification.receiver==id)
                        {
                            self.splice(index,1);
                        }
                    })
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        load_notification()
        {
            axios.get('/load_notification')
                .then((res) => {
                    this.notifications=res.data;
                })
                .catch((error) => {
                });
        }

    },
    mounted() {
        Echo.private('notifications.'+this.id)
        .listen('RealTimeNotification',(event)=>{
            let message=event.message;
            let receiver=event.receiver;
            let notification={
                "message":message,
                "receiver":receiver,
            }
            this.notifications.unshift(notification);
        })
        this.load_notification();
    },
    beforeMount() {

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
