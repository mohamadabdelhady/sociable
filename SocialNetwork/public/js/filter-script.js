var btn_all = document.getElementById("all");
var btn_user = document.getElementById("user");
var btn_post = document.getElementById("post");
btn_user.onclick = function() {
    document.getElementById('user-result').style.display='block';
    document.getElementById('post-result').style.display='none';

}
btn_post.onclick = function() {
    document.getElementById('post-result').style.display='block';
    document.getElementById('user-result').style.display='none';
}
btn_all.onclick = function() {
    document.getElementById('post-result').style.display='block';
    document.getElementById('user-result').style.display='block';
}
