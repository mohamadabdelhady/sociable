<template>
<div>
    <div class="row">
        <div class="card" v-for="(post, index) in posts">
            <div class="card-header">
            <span style="float: left"><img src="" class="user-avatar"><p></p></span>
                <span style="float:right;"></span>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer">
                <span style="float: left"><i style="font-family:Arial, FontAwesome">&#xf086;</i></span>
                <span style="float: right"><i style="font-family:Arial, FontAwesome">&#xf062;</i>
                <i style="font-family:Arial, FontAwesome">&#xf063;</i>
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
    created() {
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
