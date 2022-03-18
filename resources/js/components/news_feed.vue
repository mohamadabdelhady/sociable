<template>
<div>
    <div class="row">
        <div class="card mt-4" v-for="(post, index) in posts">
            <div class="">
            <span style="float: left"><img v-if="post['profile_img']!=null" :src="'/storage/'+post['profile_img']" class="userAvatar">
                <img v-else src="images/user_default.svg" class="userAvatar">
                <a style="font-size: 1em !important;" :href="'/get_profile/'+post['user_id']" class="rm_text_decoration"><span>{{post['first_name']+" "+post['last_name']}}</span></a>
            </span>
                <span style="float:right;"></span>
            </div>
            <div class="card-body">

            </div>
            <div>
                <a class="rm_text_decoration" href="#" style="float: left"><i style="font-family:Arial, FontAwesome">&#xf086;</i></a>
                <span style="float: right">
                    <a class="rm_text_decoration" href="#"><i style="font-family:Arial, FontAwesome">&#xf062;</i></a>
                    <span>{{post['likes']}}</span>
                    <a class="rm_text_decoration" href="#"><i style="font-family:Arial, FontAwesome">&#xf063;</i></a>
                    <span>{{post['dislikes']}}</span>
                </span>
            </div>

        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "news_feed",
    data()
    {
        return{
            posts:[],
            page:1,
            last_page:false,
        }
    },
    methods:{
        load_news_feed()
        {
            axios.get('load_news_feed'+'?page='+this.page).then(response=>{
                $.each(response.data.data, (key, v) => {
                    this.posts.push(v);
                });
            });
            this.page++;
        }
    },
    beforeMount() {
        this.load_news_feed();
    },
    mounted() {
        document.addEventListener('scroll', (e)=> {
            let documentHeight = document.body.scrollHeight;
            let currentScroll = window.scrollY + window.innerHeight;

            let modifier = 200;
            if(this.last_page==false) {
                if (currentScroll + modifier > documentHeight) {
                    this.load_news_feed();
                }
            }
        })
    }
}
</script>

<style scoped>

</style>
