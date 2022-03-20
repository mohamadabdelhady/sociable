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
                <a class="rm_text_decoration" href="#" style="float: left" v-on:click.prevent="load_comment(post['id'])"><i style="font-family:Arial, FontAwesome">&#xf086;</i></a>
                <span style="float: right">
                    <a class="rm_text_decoration" href="#" v-on:click.prevent="like(post['id'])"><i style="font-family:Arial, FontAwesome">&#xf062;</i></a>
                    <span>{{post['likes']}}</span>
                    <a class="rm_text_decoration" href="#" v-on:click.prevent="dislike(post['id'])"><i style="font-family:Arial, FontAwesome">&#xf063;</i></a>
                    <span>{{post['dislikes']}}</span>
                </span>
            </div>
            <div style="display:none;" :class="'comment'+post['id']">
            <div :class="'comment-section'+post['id']">
                <div class="mt-2">
                    <textarea class="comment-text" v-model="user_comment"></textarea>
                    <button class="btn" v-on:click="post_comment(post['id'])">Post</button>
                </div>
                <hr>
                <p class="h5 mt-3" :id="'comment-not'+post['id']" align="center" style="display: none">We didn't find any comments on this post, be the first one to comment</p>
            </div>
                <p align="center"><button class="btn" :disabled="comment_last_page">Load more comments</button></p>
            </div>
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
            user_comment:"",
            page: 1,
            last_page: false,
            page_comment: 1,
            comment_last_page: false,
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
        load_comment(id) {
            $('.comment'+id).toggle();
            $('#comment-not'+id).hide();
            $('.comment-section'+id).html(' ');
            axios.get('load_comment/' + id + '?page=' + this.page).then(response => {
                if (response.data.data.length>0) {
                    $.each(response.data.data, (key, v) => {

                        $('.comment-section'+id).append('<div class="mt-3">' +
                            '<div><img src="/storage/' + v.profile_img + ' "class="userAvatar-sm">' +
                            '<a class="rm_text_decoration ms-2" style="font-size: 1em" href="/get_profile/' + v.id + '">' + '<span class="ms-2">' + v.first_name + ' ' + v.last_name + '</span></a>' +
                            '<span style="float: right">' +moment([v.created_at],'YYYY-MM-DD HH:mm:ss').fromNow()+ '</span></div>' +
                            '<div class="comment">' + v.comment_content + '</div>' +
                            '<hr>' +
                            '</div>')
                    })
                } else {
                    $('#comment-not'+id).show();
                }
            })
                .catch((error) => {

                });
            this.page_comment++;
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
    },
        created() {
            this.load_news_feed();
        },
        mounted() {
            document.addEventListener('scroll', (e) => {
                let documentHeight = document.body.scrollHeight;
                let currentScroll = window.scrollY + window.innerHeight;
                let modifier = 200;
                if (this.last_page == false) {
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
.comment-text{
    width: 100%;
    border-radius: 3px;
    outline:none;
    border:1px solid grey;
    padding: 10px;
}
</style>
