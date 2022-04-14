<template>
<div>
    <p align="center" v-on:click="show(post_id)" :id="'show'+post_id" class="comment">Show comments</p>
    <p align="center" v-on:click="show(post_id)" :id="'hide'+post_id" style="display:none;" class="comment">Hide comments</p>
    <div class="mt-2" :id="'comments'+post_id" style="display: none;">
        <textarea class="comment-text" v-model="user_comment"></textarea>
        <button class="btn" v-on:click="post_comment(post_id)">Post</button>
        <p class="mt-2">comments number: {{comments.length}}</p>
    <hr>
    <p v-if="comments.length===0" class="h5 mt-3" :id="'comment-not'+post_id" align="center">We didn't find any comments on this post, be the first one to comment</p>
        <div v-else>
            <div v-for="(comment, index) in comments">
    <div>
        <img v-if="comment.profile_img!=null" :src="'/storage/'+comment.profile_img"class="userAvatar-sm">
        <img v-else src="/images/user_default.svg" class="userAvatar">
    <a class="rm_text_decoration ms-2" style="font-size: 1em" :href="'/get_profile/' + comment.id"><span class="ms-2">{{comment.first_name + ' ' + comment.last_name}}</span></a>
    <span style="float: right">{{get_date(comment.created_at)}}</span></div>
    <div class="comment-content">{{comment.comment_content}}</div>
    <hr>

        </div>
            <p align="center"><button class="btn" :disabled="last_page" v-on:click="load_comments">Load more comments</button></p>
        </div>
    </div   >
</div>
</template>

<script>
import moment from 'moment';
export default {
    name: "comments_section",
    props:['post_id'],
    data(){
        return{
            comments:[],
            user_comment:"",
            page: 1,
            last_page:false,
        }
    },
    methods:{
        get_date(date)
        {
            return moment([date],'YYYY-MM-DD HH:mm:ss').fromNow();
        },
        post_comment(id)
        {
            axios.post('post_comment',{
                post_id:id,
                comment:this.user_comment
            })
                .then((res) => {
                    this.user_comment="";
                    this.page=1;
                    this.load_comments()
                })
        },
        load_comments()
        {
            axios.get('load_comment/'+this.post_id + '?page=' + this.page).then(response => {
                    this.comments=response.data.data;
                    if (response.data.current_page == response.data.last_page) {
                        this.last_page = true;
                    }
            });
            this.page++;
        },
        show(id)
        {
            $('#comments'+id).toggle();
            $('#show'+id).toggle();
            $('#hide'+id).toggle();
        }
    },
    beforeMount() {
        this.load_comments();
    }
}
</script>

<style scoped>
.comment{
    cursor: pointer;
}
.comment:hover {
    background-color: hsl(0deg 0% 95%);
    width:100%;
    border-radius: 3px;
}
.comment-text{
    width: 100%;
    outline: none;
    border:1px solid grey;
}
.comment-text:focus{
    border:1px solid rgba(13, 110, 253, 0.45);
}
.comment-content{
    padding: 10px;
}
</style>
