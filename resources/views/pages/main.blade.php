
<!DOCTYPE html>
<html>
<head>
	 <meta charset="UTF-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<script src="https://kit.fontawesome.com/df75158e35.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>
@include('pages.nav-bar')
<div class=" container-fluid"style="min-height: 100vh; width: 100%" id="content">
	<div class="row">
		<div class="col-xl-3 col-lg-3">
			@include('pages.side-nav')
		</div>
		<div class="col-xl-6 col-lg-6">
			<a href="#" style="text-decoration: none; color: black;">
				<div class="card">
					<div>
					@if(auth()->user()->profile_img&&auth()->user()->google_id)
						<img src="{{url(auth()->user()->profile_img)}}" class="userAvatar">
					@elseif(auth()->user()->profile_img)
						<img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" class="userAvatar">
					@else
						<img src="/images/users_profile_img/user_default.svg" class="userAvatar">
					@endif
					<span class="ms-2">What's on your mind, <span class="users-name">{{auth()->user()->first_name}}</span>?</span>
					</div>
				</div>
			</a>
			<news_feed_crt_post></news_feed_crt_post>
		</div>
	</div>












{{--    <div class="row">--}}
{{--	<div class="col-xl-3 col-lg-3 ml-4 " id="icons_area" style="">--}}
{{--        <div class="card">--}}
{{--            <div class="mr-auto ml-auto m-2 p-1" style="border:solid 1px black;">--}}
{{--            @if(auth()->user()->profile_img)--}}
{{--                <img src="{{url('/images/users_profile_img/'.auth()->user()->profile_img)}}" style="height: 200px;width: 200px;"  id="">--}}
{{--            @else--}}
{{--                <img src="/images/user_default.png" style="height: 200px;width: 200px;"  id="">--}}
{{--            @endif--}}
{{--            </div>--}}
{{--            <div class="h5 ml-auto mr-auto"><p>{{auth()->user()->first_name." ".auth()->user()->last_name}}</p></div>--}}
{{--            <div class="mr-auto ml-auto"><span class="mr-2">Posts: {{$post_num}}</span><span class="mr-2"><span class="mr-2">Friends: {{$followers_num}}</span></div>--}}
{{--            <hr class="ml-auto mr-auto">--}}
{{--            <ul><li class="m-2"><a href="profile"><img src="/profile_icon.png" class="side_icon"><span>show my profile</span></a></li></ul>--}}

{{--        </div>--}}
{{--</div>--}}
{{--<div class="col-xl-5 col-lg-5 ">--}}

{{--    <div class="card">--}}
{{--    	<div class="card-body">--}}
{{--            <a href="#" style="text-decoration: none;" onclick="event.preventDefault(); document.getElementById('crt-post').click();">--}}
{{--            <div class="box p-2">--}}
{{--                @if(auth()->user()->profile_img)--}}
{{--    <img src="{{url('/images/users_profile_img/'.auth()->user()->profile_img)}}" id="userAvatar">--}}
{{--    @else--}}
{{--    <img src="/images/user_default.png" id="userAvatar">--}}
{{--    @endif--}}
{{--            <span class="h5">What is on your mind {{auth()->user()->first_name." ".auth()->user()->last_name}} </span>--}}
{{--            </div></a>--}}
{{--            <button id="crt-post" style="display: none" ></button>--}}

{{--            @foreach ($errors->all() as $message)--}}
{{--            <span class="" style="color: red;">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--            @endforeach--}}


{{--        </div>--}}
{{--    </div>--}}

{{--        <div id="myModal" class="modal">--}}
{{--            <div class="modal-content">--}}
{{--                <span class="close">&times;</span>--}}
{{--                <form method="POST" action="{{route('crtpost')}}"enctype="multipart/form-data" >--}}
{{--                    @csrf--}}

{{--                    <textarea class="form-control" id="textArea" rows="10" placeholder="text here" name="textinput"></textarea>--}}
{{--                    <p id="error-upload" style=" color: red;"></p>--}}
{{--                    <div class="btn-group btn-group-sm m-2" role="group" aria-label="Second group" >--}}
{{--                        <button type="button" class="btn btn-light " onclick="event.preventDefault(); document.getElementById('upload-img').click();"><img src="/picture_icon.png" id="home_icon"><p>Picture</p></button>--}}
{{--                        <input type="file"  directory  accept="image/*" style="display: none;" id="upload-img" class="form-control" name="inputimg">--}}
{{--                        <button type="button" class="btn btn-light"onclick="event.preventDefault(); document.getElementById('upload-video').click();"><img src="/video_icon.png" id="home_icon"><p>Video</p></button>--}}
{{--                        <input type="file" accept="video/*" style="display: none;" id="upload-video" class="form-control" name="inputvid">--}}

{{--                    </div>--}}
{{--                    <input type="submit" class="btn btn-outline-info " style="width: 100%;" value="Post">--}}
{{--                </form>--}}


{{--            </div>--}}

{{--        </div>--}}
{{--    <div id="myModal2" class="modal">--}}
{{--        <div class="modal-content" style="width: 400px;">--}}
{{--            <a id="close2" style="text-decoration: none;color: black;"onclick="event.preventDefault(); document.getElementById('close-btn').click()"><span></span></a>--}}
{{--            <button id="close-btn" style="display: none"></button>--}}
{{--<p class="h3">Sentiment results</p><br>--}}
{{--            <p style="color: green;">positive :<span id="pos_num"></span></p>--}}
{{--            <p style="color: red;">negative :<span id="neg_num"></span></p>--}}
{{--            <p style="color:grey;">neutral :<span id="neut_num"></span></p>--}}
{{--            <span id="span1" style="background-color: green; height: 5px; width: 20px; display: inline;"></span> <span id="span2" style="background-color: red; height: 5px; width: 20px; display: inline;"></span> <span id="span3" style="background-color: grey; height: 5px; width: 20px; display: inline"></span>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <div id="post-result">--}}
{{--        @if($post_num!=0)--}}
{{--            <br>--}}

{{--            @foreach($posts as $post)--}}
{{--                <div class="card">--}}
{{--                    @if(\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')!=null)--}}
{{--                        <div><img src="{{'/images/users_profile_img/'.\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')}}" id="userAvatar" class="m-2"><a href="../get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a>--}}

{{--                            <span style="float: right; color: #166678;" class="m-2">posted {{$diff = Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</span></div>--}}
{{--                    @else--}}
{{--                        <div><img src="/images/user_default.png" id="userAvatar" class="m-2"><a href="../get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a><span style="float: right;" class="m-2">{{$post->updated_at}}</span></div>--}}
{{--                    @endif--}}
{{--                    <hr>--}}
{{--                    <div>--}}
{{--                        <p class="m-2">{{$post->post_content}}</p>--}}
{{--                        @if($post->image_dir!=null)--}}
{{--                            <img src="{{url('/images/post_img/'.$post->image_dir)}}" id="post_img" class="m-2">--}}
{{--                        @elseif($post->video_dir)--}}
{{--                            <video id="post_img" controls class="m-2">--}}
{{--                                <source src="{{URL::asset("/images/post_vid/$post->video_dir")}}" type="video/mp4" >--}}
{{--                                Your browser does not support the video tag.--}}
{{--                            </video>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="m-2">--}}
{{--                        <input type="hidden" id="post_id" value="{{$post->id}}">--}}
{{--                        <a href="#" class="" style="color: black;text-decoration: none;font-size: 20px;" onclick="event.preventDefault(); loadcomment({{$post->id}})"><img src="/comment_icon.png" style="height: 40px;width: 40px;">--}}
{{--                            <span id="comment_num{{$post->id}}">{{\Illuminate\Support\Facades\DB::table("comments")->where("post_id",$post->id)->count()}}</span></a>--}}
{{--                        <a href="#" class="ml-auto mr-auto" style="text-decoration: none;" onclick="event.preventDefault(); get_sentiment({{$post->id}});"><img style="height: 40px;width: 40px;" class="ml-5" src="chart_icon.png"></a>--}}
{{--                        <span  style="float: right;"><a href="#"  onclick="event.preventDefault(); like({{$post->id}})"><img src="/likes_icon.png" style="height: 40px;width: 40px;"></a><span id="likenum{{$post->id}}">{{\Illuminate\Support\Facades\DB::table("posts")->where("id",$post->id)->value("likes")}}</span>--}}
{{--                                <a href="#" onclick="event.preventDefault(); dislike({{$post->id}})"><img src="/dislike_icon.png" style="height: 40px;width: 40px;"></a><span id="dislikenum{{$post->id}}">{{\Illuminate\Support\Facades\DB::table("posts")->where("id",$post->id)->value("dislikes")}}</span></span>--}}
{{--                        <div style="display: none" id="comment_sec{{$post->id}}">--}}
{{--                            <textarea id="comment_box{{$post->id}}" type="text" placeholder="Have any comments {{auth()->user()->first_name." ".auth()->user()->last_name." ?"}}" class="form-control m-2" name="comment" style="width: 95%;"></textarea><button class="btn btn-outline-primary ml-2" onclick="event.preventDefault(); postcomment({{$post->id}})">Post</button><hr>--}}
{{--                            <div class="ml-5" id="comment-sec{{$post->id}}"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <br />--}}
{{--            @endforeach--}}

{{--        @endif--}}
{{--    </div>--}}
{{--    </div>--}}
{{--    <div class="col-xl-3 col-lg-3 card " style="height:30rem; ">--}}

{{--        <span style="font-size: 20px;" class="mt-3 ml-3">Chat</span>--}}
{{--        <hr>--}}
{{--        <div class="online-contacts overflow-auto mt-2">--}}

{{--            @foreach($followers as $follower)--}}
{{--                @if($follower->profile_img!=null)--}}
{{--                    <div class="m-2"><img src="{{url('/images/users_profile_img/'.$follower->profile_img)}}" id="userAvatar">--}}
{{--                        @else--}}
{{--                            <div class="m-2"><img src="/images/user_default.png" id="userAvatar">--}}
{{--                                @endif--}}
{{--                                <a href="chat/{{$follower->id}}" style="text-decoration: none;color: black; margin-left: 10px;" href="../get-profile/{{$follower->id}}"><span id="search-username" >{{$follower->first_name." ".$follower->last_name}}--}}
{{--                                        @if(Cache::has('user-is-online-' . $follower->id))--}}
{{--                                        <span class=""style="color: green; float: right;">Online</span>--}}
{{--                                    @else--}}
{{--                                        <span class="" style="color: red; float:right;">Offline</span>--}}
{{--                                    @endif</span></a>--}}
{{--                            </div>--}}
{{--                            <br>--}}
{{--                            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--        <div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}
</div>
{{--<script>--}}
{{--    function like(post_id)--}}
{{--    {--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--            let id = post_id;--}}
{{--            let _token = $('meta[name="csrf-token"]').attr('content');--}}

{{--            $.ajax({--}}
{{--                url: "{{route('like')}}",--}}
{{--                type: "POST",--}}
{{--                data: {--}}

{{--                    id: id,--}}
{{--                    _token: _token--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    if (response) {--}}

{{--                        document.getElementById("dislikenum"+post_id).innerHTML = response['dislikes'];--}}
{{--                        document.getElementById("likenum"+post_id).innerHTML = response['likes'];--}}

{{--                    }--}}
{{--                },--}}
{{--            });--}}

{{--    }--}}
{{--    function dislike(post_id)--}}
{{--    {--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--        let id = post_id;--}}
{{--        let _token = $('meta[name="csrf-token"]').attr('content');--}}

{{--        $.ajax({--}}
{{--            url: "{{route('dislike')}}",--}}
{{--            type: "POST",--}}
{{--            data: {--}}

{{--                id: id,--}}
{{--                _token: _token--}}
{{--            },--}}
{{--            success: function (response) {--}}
{{--                // console.log(response);--}}
{{--                if (response) {--}}

{{--                    document.getElementById("dislikenum"+post_id).innerHTML = response['dislikes'];--}}
{{--                    document.getElementById("likenum"+post_id).innerHTML = response['likes'];--}}

{{--                }--}}
{{--            },--}}
{{--        });--}}

{{--    }--}}
{{--    function loadcomment(post_id)--}}
{{--    {--}}
{{--        var commentsec=document.getElementById('comment_sec'+post_id).style.display;--}}
{{--        if(commentsec=='none'){--}}
{{--            document.getElementById('comment-sec'+post_id).innerHTML="";--}}
{{--        document.getElementById('comment_sec'+post_id).style.display='block';--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            let id = post_id;--}}
{{--            let _token = $('meta[name="csrf-token"]').attr('content');--}}
{{--            $.ajax({--}}
{{--                url: "{{route('loadcomment')}}",--}}
{{--                type: "POST",--}}
{{--                data: {--}}

{{--                    id: id,--}}
{{--                    _token: _token--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    console.log(response);--}}
{{--                    if (response) {--}}

{{--                        document.getElementById("comment_num"+post_id).innerHTML =response.length;--}}
{{--                        for (var i = 0; i < response.length; i++)--}}
{{--                        {--}}
{{--                            var temp=response[i]--}}
{{--                            let date=temp['updated_at'];--}}

{{--                            document.getElementById("comment-sec"+post_id).innerHTML = document.getElementById("comment-sec"+post_id).innerHTML+"<a href='../get-profile/"+temp['user_id']+"'><p>@"+temp['first_name']+" "+temp['last_name']+"</p></a><span style='color: #166678'>"+date+"</span>"--}}
{{--                            +"<p>"+temp['comment_content']+"</p><hr>";--}}

{{--                        }--}}

{{--                    }--}}
{{--                },--}}
{{--            });--}}

{{--        }--}}
{{--        else--}}
{{--            document.getElementById('comment_sec'+post_id).style.display='none';--}}
{{--    }--}}
{{--    function postcomment(post_id)--}}
{{--    {--}}
{{--        var num=parseInt(document.getElementById("comment_num"+post_id).innerHTML );--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--        let id = post_id;--}}
{{--        let comment=$("#comment_box"+post_id).val();--}}

{{--        let _token = $('meta[name="csrf-token"]').attr('content');--}}
{{--        if(comment!="") {--}}
{{--            num=num+1;--}}
{{--            document.getElementById("comment_num"+post_id).innerHTML =num;--}}
{{--            $.ajax({--}}
{{--                url: "{{route('postcomment')}}",--}}
{{--                type: "POST",--}}
{{--                data: {--}}

{{--                    id: id,--}}
{{--                    comment: comment,--}}
{{--                    _token: _token--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                     console.log(response);--}}
{{--                    if (response) {--}}

{{--                        document.getElementById("comment_box" + post_id).value = "";--}}
{{--                        document.getElementById('comment-sec' + post_id).innerHTML = "";--}}
{{--                        $.ajax({--}}
{{--                            url: "{{route('loadcomment')}}",--}}
{{--                            type: "POST",--}}
{{--                            data: {--}}

{{--                                id: id,--}}
{{--                                _token: _token--}}
{{--                            },--}}
{{--                            success: function (data) {--}}
{{--                                console.log(response);--}}
{{--                                if (data) {--}}
{{--                                    for (var i = 0; i < data.length; i++) {--}}
{{--                                        var temp = data[i];--}}
{{--                                        let date=temp['updated_at'];--}}

{{--                                        document.getElementById("comment-sec"+post_id).innerHTML = document.getElementById("comment-sec"+post_id).innerHTML+"<a href='../get-profile/"+temp['user_id']+"'><p>@"+temp['first_name']+" "+temp['last_name']+"</p></a><span style='color: #166678'>"+date+"</span>"--}}
{{--                                            +"<p>"+temp['comment_content']+"</p><hr>";--}}

{{--                                    }--}}

{{--                                }--}}
{{--                            },--}}
{{--                        });--}}

{{--                    }--}}

{{--                },--}}

{{--            });--}}
{{--        }--}}

{{--    }--}}

{{--</script>--}}

</body>

</html>
