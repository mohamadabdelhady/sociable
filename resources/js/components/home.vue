<template>
  <div>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title float-left">Create post</h4>
          </div>
          <div class="modal-body">
            <textarea class="form-control" id="textArea" rows="10" placeholder="What is in your mind?" name="post_text" v-model="post_text"></textarea>
            <div>
              <label>Add to your post</label>
                <br>
              <a href="#" class="rm_text_decoration" style="font-family:Arial, FontAwesome" v-on:click.prevent="upload('image')">&#xf03e;</a>
              <a href="#" class="rm_text_decoration" style="font-family:Arial, FontAwesome" v-on:click.prevent="upload('video')">&#xf008;</a>
              <a href="#" class="rm_text_decoration" style="font-family:Arial, FontAwesome" v-on:click.prevent="upload('audio')">&#xf001;</a>
                <input type="file" id="post_media" name="media" v-on:change="get_file($event)" style="display:none;">
            </div>
            <p align="center"><button class="btn" v-on:click="create_post">Post</button></p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "home",
    data()
    {
        return{
            post_text:"",
            post_media:"",
            media_type:"",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods:{
      create_post()
      {
          var formData = new FormData();
          var imagefile = document.querySelector('#post_media');
          formData.append("_token", this.csrf);
          formData.append("media", imagefile.files[0]);
          formData.append("Text", this.post_text);
          formData.append("type", this.media_type);
          axios.post('create_post', formData, {
              headers: {
                  'Content-Type': 'multipart/form-data'
              }
          }).then((res)=>{
                        console.log(res)
                    }).catch((error)=>{
                        console.log(error);
                    });

      },
      upload(type)
      {
          document.getElementById('post_media').accept=type+"/*";
        document.getElementById('post_media').click();
        this.media_type=type;
      },
      get_file(event)
      {
          this.post_media=event.target.files[0];
      }
    }
}
</script>

<style scoped>
.modal-body a{
    font-size: 2em;
}
</style>
