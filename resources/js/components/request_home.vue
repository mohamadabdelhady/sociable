<template>
    <div class="mt-4">
        <p class="noti">FRIEND REQUESTS<span class="result-num">{{requests_num}}</span></p>

        <div class="card notification-area" v-for="(request, index) in requests">

        </div>

    </div>
</template>

<script>
export default {
    name: "request_home",
    data()
    {
        return{
            requests:[],
            requests_num:0,
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
