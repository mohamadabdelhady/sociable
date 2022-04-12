<template>
<div>
    <div class="row">
        <div class="card mb-4" v-for="(post, index) in posts">
            <div class="">
            <span style="float: left"><img v-if="post['profile_img']!=null" :src="'/storage/'+post['profile_img']" class="userAvatar">
                <img v-else src="images/user_default.svg" class="userAvatar">
                <a style="font-size: 1em !important;" :href="'/get_profile/'+post['user_id']" class="rm_text_decoration"><span>{{post['first_name']+" "+post['last_name']}}</span></a>
            </span>
                <span style="float:right;"></span>
            </div>
            <div class="card-body mt-2">
                <div class="mb-3">{{post['post_text']}}</div>
                <div v-if="post['media_type']=='image'">
                    <img :src="'/storage/'+post['media']" class="image-post">
                </div>
                <div v-if="post['media_type']=='video'"></div>
                <div v-if="post['media_type']=='audio'"></div>
            </div>
            <div>
                <span style="float: right">
                    <a class="rm_text_decoration" href="#" v-on:click.prevent="like(post['id'])"><i style="font-family:Arial, FontAwesome">&#xf062;</i></a>
                    <span>{{post['likes']}}</span>
                    <a class="rm_text_decoration" href="#" v-on:click.prevent="dislike(post['id'])"><i style="font-family:Arial, FontAwesome">&#xf063;</i></a>
                    <span>{{post['dislikes']}}</span>
                </span>
            </div>
            <comments_section :post_id="post['id']"></comments_section>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment';
export default {
    name: "news_feed",
    data() {
        return {
            posts: [],
            page: 1,
            last_page: false,
        }
    },
    methods: {
        load_news_feed() {
            axios.get('load_news_feed' + '?page=' + this.page).then(response => {
                $.each(response.data.data, (key, v) => {
                    this.posts.push(v);
                    if (response.data.current_page == response.data.last_page) {
                        this.last_page = true;
                    }
                });
            });
            this.page++;
        },
        like(id) {
            axios.get('like/' + id)
                .then((res) => {
                    this.posts.forEach(function (post, index, self) {
                        if (post.id == id) {
                            post.likes = res.data.likes;
                            post.dislikes = res.data.dislikes;
                        }
                    })
                }).catch((error) => {

            });
        },
        dislike(id) {
            axios.get('dislike/' + id)
                .then((res) => {
                    this.posts.forEach(function (post, index, self) {
                        if (post.id == id) {
                            post.likes = res.data.likes;
                            post.dislikes = res.data.dislikes;
                        }
                    })
                }).catch((error) => {

            });
        },
        post_comment(id)
        {
            axios.post('post_comment',{
                post_id:id,
                comment:this.user_comment
            })
                .then((res) => {

                })
        },
        show_comment(id)
        {
            $('comment'+id).toggle();
        }
    },
        created() {
            this.load_news_feed();
        },
        mounted() {
            document.addEventListener('scroll', (e) => {
                let documentHeight = document.body.scrollHeight;
                let currentScroll = window.scrollY + window.innerHeight;
                let modifier = 200;
                if (this.last_page == false&&this.posts.length!=0) {
                    if (currentScroll + modifier > documentHeight) {
                        this.load_news_feed();
                    }
                }
            })
        },

}
</script>

<style scoped>
.image-post{
    width: 100%;
    border: 1px solid grey;
}
</style>
