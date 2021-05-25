
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
<div class="row container-fluid"style="min-height: 100vh; min-width: 100%" id="content_profile">
    <div class="col-xl-1 col-lg-1"></div>
    <div class="col-xl-10 col-lg-10" >
        <div class="container">
            @if($userdata->cover_img!=null)
                <img src="{{url('/images/user_cover_img/'.$userdata->cover_img)}}" id="cover">
            @else
                <img src="/images/user_cover_img/cover_default.png" id="cover">
            @endif


        </div>
        <div class="cover-profile">
            @if($userdata->profile_img!=null)
                <img src="{{url('/images/users_profile_img/'.$userdata->profile_img)}}">
            @else
                <img src="/images/user_default.png" >
            @endif
        </div>
        <div class="cover-text">

                <p>{{$userdata->first_name." ".$userdata->last_name}}</p>

        </div>




        <hr>
        <div class="btn-group btn-group-lg m-2 btn-cover" role="group" aria-label="Second group">
            @if($is_exist==false)
            <button type="button" class="btn btn-light"><img src="/following_icon.png" id="home_icon" onclick="event.preventDefault(); document.getElementById('follow').submit();"><p>Follow</p></button>
                <form action="{{ route('follow') }}" method="POST" id="follow" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $userdata->id }}">

                </form>
            @else
                <button type="button" class="btn btn-light active"><img src="/followed_icon.png" id="home_icon" onclick="event.preventDefault(); document.getElementById('unfollow').submit();"><p>Followed</p></button>
                <form action="{{ route('unfollow') }}" method="POST" id="unfollow" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $userdata->id }}">
                </form>
            @endif
        </div>
    </div>
</div>
<div class="col-xl-1 col-lg-1" id="action_area"></div>
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
                            <div><img src="{{'/images/users_profile_img/'.\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('profile_img')}}" id="userAvatar" class="m-2"><a href="get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a></div>
                        @else
                            <div><img src="/images/user_default.png" id="userAvatar" class="m-2"><a href="get-profile/{{$post->user_id}}" class="m-2" style="text-decoration: none;color: black;">{{\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('first_name')." ".\Illuminate\Support\Facades\DB::table('users')->where('id',$post->user_id)->value('last_name')}}</a></div>
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
                    </div>
                    <br>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-xl-4 col-lg-4">
        <div class="card m-2" style="height: 18rem;">
            <p class="ml-auto mr-auto mt-2" style="font-size: 20px;">Followers</p>
            @foreach($followers as $follower)
                @if($follower->profile_img!=null)
                    <div class="m-2"><img src="{{url('/images/users_profile_img/'.$follower->profile_img)}}" id="userAvatar">
                        @else
                            <div class="m-2"><img src="/images/user_default.png" id="userAvatar">
                                @endif
                                <a style="text-decoration: none;color: black; margin-left: 10px;" href="get-profile/{{$follower->id}}"><span id="search-username" >{{$follower->first_name." ".$follower->last_name}}</span></a>
                            </div>
                            <br>
                            @endforeach
                    </div>
        </div>
    </div>

</div>
</div>
</body>
</html>
