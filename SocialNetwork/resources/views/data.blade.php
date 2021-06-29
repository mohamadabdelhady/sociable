<div id="post-result">
    @if($post_num!=0)
        <br>
        @foreach($posts as $post)
            <div class="card">
                @if(\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')!=null)
                    <div><img src="{{'/images/users_profile_img/'.\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')}}" id="userAvatar" class="m-2"><a href="../get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a>
                        <span style="float: right;" class="m-2">{{$post->updated_at}}</span></div>
                @else
                    <div><img src="/images/user_default.png" id="userAvatar" class="m-2"><a href="../get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a><span style="float: right;" class="m-2">{{$post->updated_at}}</span></div>
                @endif
                <hr>
                <div>
                    <p class="m-2">{{$post->post_content}}</p>
                    @if($post->image_dir!=null)
                        <img src="{{url('/images/post_img/'.$post->image_dir)}}" id="post_img" class="m-2">
                    @elseif($post->video_dir)
                        <video id="post_img" controls class="m-2">
                            <source src="{{URL::asset("/images/post_vid/$post->video_dir")}}" type="video/mp4" >
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
                <hr>
                <div class="m-2">
                    <input type="hidden" id="post_id" value="{{$post->id}}">
                    <a href="#" class="" style="color: black;text-decoration: none;font-size: 20px;" onclick="event.preventDefault(); loadcomment({{$post->id}})"><img src="/comment_icon.png" style="height: 40px;width: 40px;">
                        <span id="comment_num{{$post->id}}">{{\Illuminate\Support\Facades\DB::table("comments")->where("post_id",$post->id)->count()}}</span></a>
                    <span  style="float: right;"><a href="#"  onclick="event.preventDefault(); like({{$post->id}})"><img src="/likes_icon.png" style="height: 40px;width: 40px;"></a><span id="likenum{{$post->id}}">{{\Illuminate\Support\Facades\DB::table("posts")->where("id",$post->id)->value("likes")}}</span>
                                <a href="#" onclick="event.preventDefault(); dislike({{$post->id}})"><img src="/dislike_icon.png" style="height: 40px;width: 40px;"></a><span id="dislikenum{{$post->id}}">{{\Illuminate\Support\Facades\DB::table("posts")->where("id",$post->id)->value("dislikes")}}</span></span>
                    <div style="display: none" id="comment_sec{{$post->id}}">
                        <textarea id="comment_box{{$post->id}}" type="text" placeholder="Have any comments {{auth()->user()->first_name." ".auth()->user()->last_name." ?"}}" class="form-control m-2" name="comment" style="width: 95%;"></textarea><button class="btn btn-outline-primary ml-2" onclick="event.preventDefault(); postcomment({{$post->id}})">Post</button><hr>
                        <div class="ml-5" id="comment-sec{{$post->id}}"></div>
                    </div>
                </div>
            </div>
            <br />
        @endforeach
    @endif
</div>
