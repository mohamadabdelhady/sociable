
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script1.js') }}" defer></script>
    <script src="{{ asset('js/script2.js') }}" defer></script>
{{--    <script src="{{ asset('js/ratesys.js') }}" defer></script>--}}
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style-post.css') }}" rel="stylesheet">
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
  <div class="dropdown">
  <button class="btn dropdown-toggle mr-3 mybtn" type="button" id="userlogindrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/chat_icon.png" id="userAvatar"></button></div>
  <div class="dropdown">
  <button class="btn dropdown-toggle mr-3 mybtn" type="button" id="userlogindrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/notifications_icon.png" id="userAvatar"></button></div>
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

    <a class="dropdown-item" href="#"><img src="/settings.png" id="user_icons"> <span class="ml-2">settings</span></a>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/logout_icon.png" id="user_icons"> <span class="ml-2">log out</span></a>
    <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
    @csrf
    </form>


  </div>
</div>
	</div>
</nav>
<div class=" container-fluid"style="min-height: 100vh; width: 100%" id="content">
    <div class="row">
	<div class="col-xl-3 col-lg-3 ml-4 " id="icons_area" style="">
		<ul><li><a href="profile"><img src="/profile_icon.png" class="side_icon"><span>My profile</span></a></li></ul>
		<hr>
		<ul><li><a href="#"><img src="/groups_icon.png" class="side_icon"><span>My groups</span></a></li></ul>
	<ul><li><a href="#"><img src="/flag_icon.png" class="side_icon"><span>My pages</span></a></li></ul>
		<hr>
		<ul><li><a href="#"><img src="/market_icon.png" class="side_icon"><span>Market</span></a></li></ul>
		<ul><li><a href="#"><img src="/product_icon.png" class="side_icon"><span>My products</span></a></li></ul>
		<hr>
		<ul><li><a href="#"><img src="/event_icon.png" class="side_icon"><span>Events</span></a></li></ul>
		<ul><li><a href="#"><img src="/trending_icon.png" class="side_icon"><span>Trending</span></a></li></ul>
</div>
<div class="col-xl-5 col-lg-5 ">

    <div class="card">
    	<div class="card-body">
            <a href="#" style="text-decoration: none;" onclick="event.preventDefault(); document.getElementById('crt-post').click();">
            <div class="box p-2">
                @if(auth()->user()->profile_img)
    <img src="{{url('/images/users_profile_img/'.auth()->user()->profile_img)}}" id="userAvatar">
    @else
    <img src="/images/user_default.png" id="userAvatar">
    @endif
            <span class="h5">What is on your mind {{auth()->user()->first_name." ".auth()->user()->last_name}} </span>
            </div></a>
            <button id="crt-post" style="display: none" ></button>

  </div>
    </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form method="POST" action="{{route('crtpost')}}"enctype="multipart/form-data" >
                    @csrf
                    <input type="text" placeholder="Title" class="form-control m-1" name="title">
                    <textarea class="form-control" id="textArea" rows="10" placeholder="text here" name="textinput"></textarea>
                    <p id="error-upload" style="display:none; color: red;"></p>
                    <div class="btn-group btn-group-sm m-2" role="group" aria-label="Second group" >
                        <button type="button" class="btn btn-light " onclick="event.preventDefault(); document.getElementById('upload-img').click();"><img src="/picture_icon.png" id="home_icon"><p>Picture</p></button>
                        <input type="file"  directory  accept="image/*" style="display: none;" id="upload-img" class="form-control" name="inputimg">
                        <button type="button" class="btn btn-light"onclick="event.preventDefault(); document.getElementById('upload-video').click();"><img src="/video_icon.png" id="home_icon"><p>Video</p></button>
                        <input type="file" accept="video/*" style="display: none;" id="upload-video" class="form-control" name="inputvid">


                    </div>
                    <input type="submit" class="btn btn-outline-info " style="width: 100%;" value="Post">
                </form>


            </div>

        </div>
    <div id="post-result">
        @if($post_num!=0)
            <br>
            @foreach($posts as $post)
                <div class="card">
                    @if(\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')!=null)
                        <div><img src="{{'/images/users_profile_img/'.\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')}}" id="userAvatar" class="m-2"><a href="get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a>
                            <span style="float: right;" class="m-2">{{$post->updated_at}}</span></div>
                    @else
                        <div><img src="/images/user_default.png" id="userAvatar" class="m-2"><a href="get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a><span style="float: right;" class="m-2">{{$post->updated_at}}</span></div>
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
    <div class="col-xl-3 col-lg-3 card " style="height:30rem; ">
        <input class="form-control m-2" type="search" placeholder="Search users" aria-label="Search" id="search-input" style="width: 100%;" >
        <span style="font-size: 20px;" class="mt-3 ml-3">Online users</span>
        <hr>
        <div class="online-contacts overflow-auto mt-2">

        </div>
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
                    console.log(response);
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
                console.log(response);
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

                            document.getElementById("comment-sec"+post_id).innerHTML = document.getElementById("comment-sec"+post_id).innerHTML+"<a href='get-profile/"+temp['user_id']+"'><p>@"+temp['first_name']+" "+temp['last_name']+"</p></a>"
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
        num=num+1;
        document.getElementById("comment_num"+post_id).innerHTML =num;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let id = post_id;
        let comment=$("#comment_box"+post_id).val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{route('postcomment')}}",
            type: "POST",
            data: {

                id: id,
                comment:comment,
                _token: _token
            },
            success: function (response) {
                console.log(response);
                if (response) {

                    document.getElementById("comment_box"+post_id).value = "";
                    $.ajax({
                        url: "{{route('loadcomment')}}",
                        type: "POST",
                        data: {

                            id: id,
                            _token: _token
                        },
                        success: function (data) {
                            console.log(response);
                            if (data) {
                                for (var i = 0; i < data.length; i++)
                                {
                                    var temp=data[i];

                                    document.getElementById("comment-sec"+post_id).innerHTML = document.getElementById("comment-sec"+post_id).innerHTML+"<a href='get-profile/"+temp['user_id']+"'><p>@"+temp['first_name']+" "+temp['last_name']+"</p></a>"
                                        +"<p>"+temp['comment_content']+"</p><hr>";

                                }

                            }
                        },
                    });

                }
            },
        });

    }
</script>
</body>

</html>
