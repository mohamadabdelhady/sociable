<template>
    <div class="wrapper">
        <p class="noti">FRIEND REQUESTS<span class="result-num">{{requests.length}}</span></p>

        <div class="card mb-2 me-2" v-for="(request, index) in requests">
<!--            <a style="font-family:Arial, FontAwesome" href="#" class="close rm_text_decoration" v-on:click.prevent="rm_notification">&#xf00d</a>-->
            <img :src="'storage/'+request.avatar" class="user-avatar" v-if="request.avatar!=null && request.avatar!='default'">
            <img :src="'images/user_default.svg'" class="user-avatar" v-else>
            <p>{{request.message}}</p>
            <div>
                <button class="accept-btn btn me-4" v-on:click="accept_request(request.requester)">Accept</button>
                <button class="decline-btn btn" v-on:click="decline_request(request.requester)">Decline</button>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "request_home",
    props:['id'],
    data()
    {
        return{
            requests:[],
        }
    },
    methods:{
        accept_request(requester)
        {
            axios.get('accept/'+requester)
                .then((res) => {
                    console.log('ac')
                })
                .catch((error) => {
                    console.log('error')
                });
        },
        decline_request(requester)
        {
            axios.get('decline/'+requester)
                .then((res) => {
                    let self=this.requests;
                    this.requests.forEach(function(request, index,self){
                        if(request.requester==requester)
                        {
                           self.splice(index,1);
                        }
                    })
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        load_requests()
        {
            let self=this;
            axios.get('/load_request')
                .then((res) => {
                    res.data.forEach(request=>{
                       let R={
                           "message":request.first_name+' '+request.last_name+' want to be your friend.',
                           "requester":request.id,
                           "avatar":request.profile_img,
                       }
                        this.requests.unshift(R);
                    });
                })
                .catch((error) => {
                });
        }
    },
    mounted() {
        Echo.private('requests.'+this.id)
            .listen('RealTimeRequests',(event)=>{
                let message=event.message;
                let requester=event.requester;
                let avatar=event.avatar;
                let request={
                    "message":message,
                    "requester":requester,
                    "avatar":avatar,
                }
                this.requests.unshift(request);
            })
        this.load_requests();
    },
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
.accept-btn{
    color: white;
    background-color: limegreen;
    box-shadow: none;
    border: none;
}
.decline-btn{
    color: white;
    background-color: #f36767;
    box-shadow: none;
    border: none;
}
.user-avatar{
    height:40px;
    width: 40px;
    border-radius: 3px;
}
</style>
