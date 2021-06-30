
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/filter-script.js') }}" defer></script>
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
<div class="row container-fluid"style="min-height: 100vh; min-width: 100%" id="content">
    <div class="col-xl-4 col-lg-4 ml-4 " style="">
        <div id="mySidemenu" class="sidemenu">
           <p style="font-size: 25px;font-weight: bold;" class="pl-3">Search results</p><hr>
            <p style="font-size: 20px;font-weight: bold;" class="pl-3">Filters</p>
            <a href="#" id="all-link" onclick="event.preventDefault(); document.getElementById('all').click();"><span>All</span><span>{{" (".$total.")"}}</span></a>
            <button style="display: none" id="all"></button>
            <a href="#" id="user-link" onclick="event.preventDefault(); document.getElementById('user').click();"><span>People</span><span>{{"   (".$user_num.")"}}</span></a>
            <button style="display: none" id="user"></button>
            <a href="#" id="post_link" onclick="event.preventDefault(); document.getElementById('post').click();"><span>Posts</span><span>{{"   (".$post_num.")"}}</span></a>
            <button style="display: none" id="post"></button>
        </div>
    </div>
    <div class="col-xl-5 col-lg-5 ">
        <div id="user-result" class="">
            @if($user_num!=0)
                <p style="font-size: 25px">People</p><hr>
                @foreach($user as $user)

                    <div class="card">
                        @if($user['profile_img']!=null)
                        <div><img src="{{url('/images/users_profile_img/'.$user['profile_img'])}}" id="search-prof">

                            @else
                                <div><img src="images/user_default.png" id="search-prof">
                                    @endif
                                   <a style="text-decoration: none;color: black;" href="get-profile/{{$user['id']}}"><span id="search-username" >{{$user['first_name']." ".$user['last_name']}}</span></a>
                                </div>

                    </div>
                        <br>
                @endforeach
            @endif
        </div>
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
                    console.log(response);
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
                                console.log(response);
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
</script>
</body>
</html>
