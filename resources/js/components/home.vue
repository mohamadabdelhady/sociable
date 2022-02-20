<template>
  <div>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title float-left">Create post</h4>
          </div>
          <div class="modal-body">
            <textarea class="form-control" id="textArea" rows="10" placeholder="What is in your mind?" name="post_text"></textarea>
            <div>
              <label>Add to your post</label>
                <br>
              <a style="font-family:Arial, FontAwesome">&#xf03e;</a>
              <a style="font-family:Arial, FontAwesome">&#xf008;</a>
              <a style="font-family:Arial, FontAwesome">&#xf001;</a>
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
  name: "home"
}
</script>

<style scoped>
.modal-body a{
    font-size: 2em;
}
</style>
