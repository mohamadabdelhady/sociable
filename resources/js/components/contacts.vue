<template>
    <div>
        <p class="noti">CONTACTS<span class="result-num">{{contacts_num}}</span></p>
        <div class="card notification-area" v-for="(contact, index) in contacts">

        </div>
    </div>
</template>

<script>
export default {
    name: "contacts",
    data()
    {
        return{
            contacts:[],
            contacts_num:0,
        }
    },
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
