
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
<nav class="navbar navbar-dark"id="nav-bar" >
    <div class="container-fluid" >
        <div class="navbar-brand" id="logo-img"></div>
        <form class="navbar-nav ml-auto mr-auto" id="Search-form" method="get" action="{{route('search-results')}}">@csrf
            <input class="form-control " type="search" placeholder="Search" aria-label="Search" id="search-input" name="q">
        </form>

        <button class="btn mybtn mr-3" style="border: none;box-shadow: none;" onclick="event.preventDefault(); document.getElementById('home-form').submit();">
            <form action="{{route('main')}}" method="get" style="display: none;" id="home-form"></form>
            <img src="/home_icon.png" id="home_icon">
        </button>
        <div id="notifications">
            <notifications :myid="{{auth()->id()}}"></notifications>
        </div>
        <div id="friends_requests">
            <friends_requests :id="{{auth()->id()}}"></friends_requests>
        </div>
        <div class="dropdown">

            <button class="btn dropdown-toggle mr-3 mybtn" type="button" id="userlogindrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(auth()->user()->profile_img)
                    <img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" id="userAvatar"><span
                        class="ml-3">{{auth()->user()->first_name." ".auth()->user()->last_name}}</span>
                @else
                    <img src="/images/user_default.png" id="userAvatar"><span
                        class="ml-3">{{auth()->user()->first_name." ".auth()->user()->last_name}}</span>
                @endif


            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <a class="dropdown-item" href="{{route('settings')}}"onclick="event.preventDefault(); document.getElementById('settings').submit();"><img src="/settings.png" id="user_icons"> <span class="ml-2">settings</span></a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/logout_icon.png" id="user_icons"> <span class="ml-2">log out</span></a>
                <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                    @csrf
                </form>
                <form id="settings" action="{{route('settings')}}" method="post" style="display: none;">
                    @csrf
                </form>


            </div>
        </div>
    </div>
</nav>
<div class="row container-fluid"style="min-height: 100vh; min-width: 100%" id="content_profile">
	<div class="col-xl-1 col-lg-1"></div>
	<div class="col-xl-10 col-lg-10" >
		<div class="container">
		@if(auth()->user()->cover_img!=null)
    <img src="{{url('/images/user_cover_img/'.auth()->user()->cover_img)}}" id="cover">
    @else
    <img src="/images/user_cover_img/cover_default.png" id="cover">
    @endif

        <div class="dropdown editbtn">
            <button class="btn btn-light ml-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Edit cover/profile
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('upload-img_prof').click();">Change profile image</a>

                <form id="change_prof" action="{{route('prof_ch')}}" method="post"  style="display: none;" enctype="multipart/form-data"> @csrf
                    <input type="file"  directory  accept="image/*" style="display: none;" id="upload-img_prof" class="form-control" name="profimg" onchange="document.getElementById('change_prof').submit()">
                </form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('upload-img_cover').click();">Change cover image</a>
                <form id="change_cover" action="{{route('cover_ch')}}" method="post"  style="display: none;" enctype="multipart/form-data"> @csrf
                    <input type="file"  directory  accept="image/*" style="display: none;" id="upload-img_cover" class="form-control" name="coverimg" onchange="document.getElementById('change_cover').submit()">
                </form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('remove_profile').submit();">Remove profile image</a>
                <form id="remove_profile" action="{{route('profile_rm')}}" method="post"  style="display: none;" > @csrf
                </form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('remove_cover').submit();">Remove cover image</a>
                <form id="remove_cover" action="{{route('cover_rm')}}" method="post"  style="display: none;" > @csrf
                </form>
            </div>
        </div>
    </div>

    <div class="cover-profile">
    @if(auth()->user()->profile_img!=null)
    <img src="{{url('/images/users_profile_img/'.auth()->user()->profile_img)}}">
    @else
    <img src="/images/user_default.png" >
    @endif
  </div>
  <div class="cover-text">
    <p>{{auth()->user()->first_name." ".auth()->user()->last_name}}</p>
  </div>
  <hr>
</div>

	<div class="col-xl-1 col-lg-1" id="action_area"></div>
</div>
    <div class="row "  style="width: 100%">
        <div class="col-xl-1 col-lg-1" id="action_area"></div>
        <div class="col-xl-6 col-lg-6 ">
            <img src="/timeline_icon.png" id="home_icon"><span class="ml-1">Time line</span>
            <hr>
            <div id="post-result">
                @if($post_num!=0)
                    <br>

                    @foreach($posts as $post)
                        <div class="card">
                            @if(\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')!=null)
                                <div><img src="{{'/images/users_profile_img/'.\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')}}" id="userAvatar" class="m-2"><a href="../get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a>

                                    <span style="float: right; color: #166678;" class="m-2">posted {{$diff = Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</span></div>
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
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card m-2" style="height: 19rem;">
                <p class="ml-auto mr-auto mt-2" style="font-size: 20px;">bio</p>
                <p style="min-height: 10rem; " class="m-2" id="bio_view">{{auth()->user()->bio}}</p>
                <button class="btn btn-primary ml-auto mr-auto" style="width: 90%;" id="update-bio" onclick="show_bio()">update your bio</button>
                <form method="POST" action="{{route('save_bio')}}">
                    @csrf
                <textarea class="form-control" name="bio" style="min-height: 10rem;display: none;" id="bio_text"></textarea>
                <button type="submit" class="btn btn-primary ml-auto mr-auto form-control" style="width: 90%; display: none;" id="save-bio">save your bio</button>

                </form>
                <button class="btn btn-danger ml-auto mr-auto mt-1" id="abort_save" style="width: 90%; display: none;">Abort</button>
            </div>
            <div class="card m-2" style="height: 18rem;">
                <p class="ml-auto mr-auto mt-2" style="font-size: 20px;">Friends</p>
                @foreach($followers as $follower)
                    @if($follower->profile_img!=null)
                        <div class="m-2"><img src="{{url('/images/users_profile_img/'.$follower->profile_img)}}" id="userAvatar">
                            @else
                                <div class="m-2"><img src="/images/user_default.png" id="userAvatar">
                                    @endif
                                    <a style="text-decoration: none;color: black; margin-left: 10px;" href="../get-profile/{{$follower->id}}"><span id="search-username" >{{$follower->first_name." ".$follower->last_name}}</span></a>
                                </div>
                            <br>
                                @endforeach
                        </div>
            </div>
        </div>

    </div>
<script>
    function like(post_id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let id = post_id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{route('like')}}",
            type: "POST",
            data: {

                id: id,
                _token: _token
            },
            success: function (response) {
                // console.log(response);
                if (response) {

                    document.getElementById("dislikenum"+post_id).innerHTML = response['dislikes'];
                    document.getElementById("likenum"+post_id).innerHTML = response['likes'];

                }
            },
        });

    }
    function dislike(post_id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let id = post_id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{route('dislike')}}",
            type: "POST",
            data: {

                id: id,
                _token: _token
            },
            success: function (response) {
                // console.log(response);
                if (response) {

                    document.getElementById("dislikenum"+post_id).innerHTML = response['dislikes'];
                    document.getElementById("likenum"+post_id).innerHTML = response['likes'];

                }
            },
        });

    }
    function loadcomment(post_id)
    {
        var commentsec=document.getElementById('comment_sec'+post_id).style.display;
        if(commentsec=='none'){
            document.getElementById('comment-sec'+post_id).innerHTML="";
            document.getElementById('comment_sec'+post_id).style.display='block';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id = post_id;
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{route('loadcomment')}}",
                type: "POST",
                data: {

                    id: id,
                    _token: _token
                },
                success: function (response) {
                    console.log(response);
                    if (response) {

                        document.getElementById("comment_num"+post_id).innerHTML =response.length;
                        for (var i = 0; i < response.length; i++)
                        {
                            var temp=response[i];

                            document.getElementById("comment-sec"+post_id).innerHTML = document.getElementById("comment-sec"+post_id).innerHTML+"<a href='../get-profile/"+temp['user_id']+"'><p>@"+temp['first_name']+" "+temp['last_name']+"</p></a>"
                                +"<p>"+temp['comment_content']+"</p><hr>";

                        }

                    }
                },
            });

        }
        else
            document.getElementById('comment_sec'+post_id).style.display='none';
    }
    function postcomment(post_id)
    {
        var num=parseInt(document.getElementById("comment_num"+post_id).innerHTML );

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let id = post_id;
        let comment=$("#comment_box"+post_id).val();

        let _token = $('meta[name="csrf-token"]').attr('content');
        if(comment!="") {
            num=num+1;
            document.getElementById("comment_num"+post_id).innerHTML =num;
            $.ajax({
                url: "{{route('postcomment')}}",
                type: "POST",
                data: {

                    id: id,
                    comment: comment,
                    _token: _token
                },
                success: function (response) {
                    // console.log(response);
                    if (response) {

                        document.getElementById("comment_box" + post_id).value = "";
                        document.getElementById('comment-sec' + post_id).innerHTML = "";
                        $.ajax({
                            url: "{{route('loadcomment')}}",
                            type: "POST",
                            data: {

                                id: id,
                                _token: _token
                            },
                            success: function (data) {
                                // console.log(response);
                                if (data) {
                                    for (var i = 0; i < data.length; i++) {
                                        var temp = data[i];

                                        document.getElementById("comment-sec" + post_id).innerHTML +=  "<a href='../get-profile/" + temp['user_id'] + "'><p>@" + temp['first_name'] + " " + temp['last_name'] + "</p></a>"
                                            + "<p>" + temp['comment_content'] + "</p><hr>";

                                    }

                                }
                            },
                        });

                    }

                },

            });
        }

    }
    function show_bio(){
        document.getElementById('update-bio').style.display='none';
        document.getElementById('bio_view').style.display='none';
        document.getElementById('save-bio').style.display='block';
        document.getElementById('bio_text').style.display='block';
        document.getElementById('abort_save').style.display='block';
    }
    var abo=document.getElementById('abort_save');
    abo.onclick=function(){
        document.getElementById('update-bio').style.display='block';
        document.getElementById('bio_view').style.display='block';
        document.getElementById('save-bio').style.display='none';
        document.getElementById('bio_text').style.display='none';
        document.getElementById('abort_save').style.display='none';
    }
</script>
</body>
</html>
