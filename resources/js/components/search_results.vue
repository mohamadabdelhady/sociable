<template>
    <div class="row">
        <div class="col-xl-3 col-lg-3">
            <div class="card search-btn">
                <h4 align="center" class="mb-4">Search results</h4>
                <a v-on:click="()=>this.selected='people'" style="font-family:Arial, FontAwesome">&#xf500;<span class="ms-2">People</span>
                    <span class="result-num">{{people.length}}</span>
                </a>
                <hr>
                <a v-on:click="()=>this.selected='posts'" style="font-family:Arial, FontAwesome">&#xf249;<span class="ms-2">Posts</span>
                    <span class="result-num">0</span>
                </a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="people-results">

            <div v-for="(person, index) in people_result" class="card people-card mb-3">
                <a :href="'get_profile/'+person['id']">
                    <div>
                <img v-if="person['profile_img']" :src="'storage/'+person['profile_img']" class="prof-img">
                    <img v-else src="/images/user_default.svg" class="userAvatar">
                <span class="ms-2">{{person['first_name']+" "+person['last_name']}}</span>
                    </div>
                    </a>
<!--                <span style="font-family:Arial, FontAwesome" class="add-btn" v-on:click="send_friend_request(person['id'])">&#xf234;</span>-->
            </div>
            </div>
            <div class="posts-results">

                <div v-for="(post, index) in posts" class="card">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "search_results",
    props:['people'],
    data()
    {
        return{
            selected:"people",
            people_result:this.people,
            posts:[],
        }
    },
    methods:{
        send_friend_request(id)
        {
            axios.get('send_friend_request/'+id)
                .then((res)=>{

                })
                .catch((error)=>{

                    });
        }
    },
    watch:{
        selected:function(newVal,oldVal)
        {
            $("."+oldVal+"-results").hide();
            $("."+newVal+"-results").show();
        }
    }
}
</script>

<style scoped>
.posts-results{display: none}
.search-btn a{cursor:pointer}
.prof-img{
    width: 40px;
    height: 40px;
    border-radius:15%;
}
.add-btn{
    float: right;
    cursor: pointer;
    font-size: 2em;
}
.people-card{
    width: 100%;
    display: inline-block;

}
.people-card a{text-decoration: none; color: black;}
</style>
