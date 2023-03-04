<template>
    <div>
    <div class="contact">
        <p class="noti">CONTACTS<span class="result-num">{{contacts.length}}</span></p>
        <div class="card notification-area" v-for="(contact, index) in contacts">
            <div>

            <img :src="'storage/'+contact.profile_img" class="userAvatar" v-if="contact.profile_img!=null">
            <img v-else src="images/user_default.svg" class="userAvatar">
                <a :href="'get_profile/'+contact.id" class="rm_text_decoration">
                <span style="vertical-align:bottom" class="ms-2">{{contact.first_name+" "+contact.last_name}}</span>
                </a>
                <a href="#" v-on:click="start_chat(contact.id,contact.first_name,contact.last_name,contact.profile_img)"><span class="chat">Chat</span></a>
            </div>
        </div>
    </div>
    <div class="chat-contact card">
        <span style="cursor: pointer; font-size: medium" v-on:click="back"><i style="font-family:Arial, FontAwesome" class="me-1">&#xf060;</i>back</span>
        <div class="mt-2">
        <img :src="'storage/'+chat_profile" class="userAvatar" v-if="chat_profile!=null">
        <img v-else src="images/user_default.svg" class="userAvatar">
        <a :href="'get_profile/'+chat_id" class="rm_text_decoration">
            <span style="vertical-align:bottom" class="ms-2">{{chat_name}}</span>
        </a>
        </div>
        <div class="chat-area mt-1">
        <div v-for="(message, index) in chat" class="mt-2">
            <p><span v-if="message.user_from==id" style="background-color: #8989ff">{{message.content}}</span></p>
            <p><span v-if="message.user_from==chat_id" style="float: right; background-color: #bdbdf8">{{message.content}}</span></p>
        </div>
        </div>
        <div class="chat-input mt-1">
            <span><textarea type="text" v-model="message"></textarea><button class="btn ms-1" v-on:click="send">Chat</button></span>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "contacts",
    props:['id'],
    data()
    {
        return{
            contacts:[],
            chat_name:"",
            chat_profile:"",
            chat_id:"",
            chat:[],
            message:""
        }
    },
    beforeMount() {
        this.get_contacts();
    },
    methods:
        {
            get_contacts()
            {
                axios.get('/get_contact/'+this.id)
                    .then((res) => {
                        this.contacts=res.data;
                    })
                    .catch((error) => {
                        // error.response.status Check status code
                    });
            },
            start_chat(id,first_name,last_name,profile)
            {
                this.chat_id=id;
                this.chat_name=first_name+' '+last_name;
                this.chat_profile=profile;
                $('.contact').toggle();
                $('.chat-contact').toggle();
                axios.get('/get_chat/'+id)
                    .then((res)=>{
                        this.chat=res.data;
                    })
                    .catch((error)=>{

                    });
            },
            back()
            {
                $('.contact').toggle();
                $('.chat-contact').toggle();
            },
            send()
            {
                axios.post('/send_chat',{
                    user_id:this.chat_id,
                    message:this.message
            })
                    .then((res)=>{

                    })
                    .catch((error)=>{

                    });
            }
        }
}
</script>

<style scoped>
.noti{
    color: grey;
    font-weight: bold;
}
.notification-area{
    height: 50vh;
}
.chat{
    padding: 5px;
    border-radius: 5px;
    background-color:#212529;
    color: white;
    vertical-align: bottom;
    float: right;
    font-size: .8em;
}
.chat-contact{
    display: none;
}
.chat-area{
    border: 1px solid grey;
    border-radius: 3px;
    min-height: 180px;
}
.chat-area span{
    margin: 10px;
    padding: 5px;
    border-radius: 3px;

}
.chat-input textarea{
    border:1px solid grey;
    outline: none;
    border-radius: 3px;
    width: 100%;
    resize: none;
}
</style>
