<template>
<div>
    <div style="float: right">
    <i style="font-family:Arial, FontAwesome;font-size: small;cursor: pointer" v-on:click="edit_bio" id="edit_btn">&#xf304</i>
    <i style="font-family:Arial, FontAwesome;font-size: small;display: none;color: red;cursor: pointer" v-on:click="edit_bio" id="discard_btn">&#xf00d</i>
    </div>
    <br>
    <br>
    <div class="mt-2" id="my_bio">
    <p class="bio" id="user_bio" v-if="my_bio!=null">{{my_bio}}</p>
        <p v-else>
            Tell the people about yourself
        </p>
    </div>
    <div style="display: none;" id="bio">
    <textarea class="bio form-control m-1"  id="textArea" rows="10" placeholder="Tell people about yourself." v-model="bio_text"></textarea>
    <button v-on:click="save_bio" class="btn m-auto ">Save</button>
    </div>
</div>
</template>

<script>
export default {
    name: "edit_user_bio",
    props:['my_bio'],
    data()
    {
        return {
            bio_text:"",
        }
        },
    methods:{
        // get_bio()
        // {
        //     axios.get('load_bio/')
        //         .then((res) => {
        //
        //         }).catch((error) => {
        //
        //     });
        // }
        save_bio()
        {
            axios.post('save_bio',{bio:this.bio_text})
                .then((res) => {
                    this.edit_bio();
                }).catch((error) => {

            });
        },
        edit_bio()
        {
            $('#bio').toggle();
            $('#edit_btn').toggle();
            $('#discard_btn').toggle();
            $('#my_bio').toggle();
        },
        fill_text()
        {
            if (this.my_bio != null) {
                this.bio_text=this.my_bio;
            }
        }
    },
    mounted(){
        this.fill_text();
    }
}
</script>

<style scoped>
.bio{
    width: 100%;
    height:200px;
    overflow: auto;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
.bio::-webkit-scrollbar {
    display: none;
}

</style>
