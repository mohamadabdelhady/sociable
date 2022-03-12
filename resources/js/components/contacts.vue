<template>
    <div>
        <p class="noti">CONTACTS<span class="result-num">{{contacts.length}}</span></p>
        <div class="card notification-area" v-for="(contact, index) in contacts">
            <div>

            <img :src="'storage/'+contact.profile_img" class="userAvatar" v-if="contact.profile_img!=null">
            <img v-else src="images/user_default.svg" class="userAvatar">
                <a :href="'get_profile/'+contact.id" class="rm_text_decoration">
                <span style="vertical-align:bottom" class="ms-2">{{contact.first_name+" "+contact.last_name}}</span>
                </a>
                <a href="#"><apan class="chat">Chat</apan></a>
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
                        console.log(res.data)
                    })
                    .catch((error) => {
                        // error.response.status Check status code
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
    height: 200px;
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
</style>
