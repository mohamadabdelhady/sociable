<template>
<div>
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create post</h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" id="textArea" rows="10" placeholder="What is in your mind?" name="post_text"></textarea>
          <div>
            <label>Add to your post</label>
            <a style="font-family:Arial, FontAwesome">&#xf03e;<span class="ml-2">Photo</span></a>
            <a style="font-family:Arial, FontAwesome">&#xf008;<span class="ml-2">Video</span></a>
            <a style="font-family:Arial, FontAwesome">&#xf001;<span class="">Audio</span></a>
          </div>
          <p align="center"><button class="btn">Post</button></p>
        </div>
      </div>

    </div>
  </div>
</div>
</template>

<script>
export default {
  name: "news_feed_crt_post"
}
</script>

<style scoped>

</style>