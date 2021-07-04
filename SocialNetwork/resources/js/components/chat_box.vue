<template>
    <div class="content_chat">
        <div class="container p-0">
            <div class="card">
                <div class="row g-0">
                    <div class="col-12 col-lg-6 col-xl-3 border-right">

                        <div class="px-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div id="users">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="d-block d-lg-none mt-1 mb-0">
                    </div>
                    <div class="col-12 col-lg-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-center py-1">
                                <div class="position-relative">
                                    <img v-if="profile==null" src="/images/user_default.png" class="rounded-circle mr-1" alt="" width="40" height="40">
                                    <img v-if="profile!=null" v-bind:src="'/images/users_profile_img/'+profile" class="rounded-circle mr-1" alt="" width="40" height="40">

                                </div>
                                <div class="flex-grow-1 pl-3">
                                    <strong>{{username}}</strong>
                                    <div class="text-muted small"><em></em></div>
                                </div>
                                <div>
                                    <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4" style="min-height:200px" id="messages">

                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="text" class="form-control"  placeholder="Type your message" v-model="mymessage">
                                <button class="btn btn-primary ml-2"  v-on:click="send_message()":disabled="mymessage==''">Send</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['userinfo','myid'],
    data(){
        return{
            username:this.userinfo['first_name']+" "+this.userinfo['last_name'],
            profile:this.userinfo['profile_img'],
            userid:this.userinfo['id'],
            mymessage:'',


        }
    },
    methods:{
        send_message(){
            axios.post('/send_message',{
            message:this.mymessage,
                id:this.userid,
            })
            let message=this.mymessage;
             let buble=(message.length)*20;
            document.getElementById('messages').innerHTML+="<p class='chat-message-right' class='' style=' padding-right:10px;border-radius: 25px;background-color:#37daec;width:"+buble+"px'>"+message+"</p>";
            this.mymessage='';
            var messageBody = document.querySelector('.chat-messages');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        },
        fetch_all_message()
        {
            axios.get('/get_messages'+this.userid).then(resp=>{
                let num=resp.data.length;
                for(var i=0;i<num;i++)
                {
                    let arr=resp.data[i];
                    if(arr['sender']==this.myid){
                        let message=arr['message_content'];
                        let buble=(message.length)*20;
                        document.getElementById('messages').innerHTML+="<p class='chat-message-right' class='' style=' padding-right:10px;border-radius: 25px;background-color:#37daec;width:"+buble+"px'>"+message+"</p>";
                    }
                    else
                    {
                        let message=arr['message_content'];
                        let buble=(message.length)*20;
                        document.getElementById('messages').innerHTML+="<p class='chat-message-left' class='' style=' padding-left:10px;border-radius: 25px;background-color:#D4F1F4;width:"+buble+"px'>"+message+"</p>";

                    }
                    var messageBody = document.querySelector('.chat-messages');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

                }
            })
        },
        notify()
        {

        },
        get_all_followers()
        {
            axios.get('/get_followers').then(resp=> {
                console.log(resp.data);
                let num=resp.data.length;
                for(var i=0;i<num;i++)
                {
                    let arr=resp.data[i];
                    if(arr['profile_img']==null)
                    document.getElementById('users').innerHTML+="<div class=\"mt-2\"><a style='text-decoration: none;' href='../chat/"+arr['id']+"'><img src=\"/images/user_default.png\" id=\"userAvatar\"><span class='m-2'>"+arr['first_name']+" "+arr['last_name']+"<img src='/envelope_icon.png' class='m-2' style='width: 10px;height: 10px; margin: 0;display: none;'></span></div>";
                    else
                        document.getElementById('users').innerHTML+="<div class=\"mt-2\"><a style='text-decoration: none;' href='../chat/"+arr['id']+"'><img src=\'/images/users_profile_img/"+arr['profile_img']+"'id=\"userAvatar\"><span class='m-2'>"+arr['first_name']+" "+arr['last_name']+"</span><img src='/envelope_icon.png' class='m-2' style='width: 10px;height: 10px; display: none;'></a></div>";
                }
            })
        }
    },
    mounted() {
        window.Echo.private("chat"+this.myid)
            .listen('MessageSend', (e) => {
                let sender=e.sender;
                if (sender==this.userid)
                {
                    let buble=(e.message.length)*20;
                    document.getElementById('messages').innerHTML+="<p class='chat-message-left' style='  padding-left:10px;border-radius: 25px;background-color:#D4F1F4;width:"+buble+"px'>"+e.message+"</p>";
                    var messageBody = document.querySelector('.chat-messages');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

                }
            });
    },
    beforeMount(){
        this.fetch_all_message();
        this.get_all_followers();
    },
}


</script>

<style scoped >

@import "chat-box.css";

</style>
