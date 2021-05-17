
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script2.js') }}" defer></script>
    <script src="{{ asset('js/filter-script.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-post.css') }}" rel="stylesheet">
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
                <a class="dropdown-item" href="#"><img src="/notifications_icon.png" id="user_icons"> <span class="ml-2">notifications</span></a>
                <a class="dropdown-item" href="#"><img src="/settings.png" id="user_icons"> <span class="ml-2">settings</span></a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/logout_icon.png" id="user_icons"> <span class="ml-2">log out</span></a>
                <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
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
                        <span id="search-username">{{$user['first_name']." ".$user['last_name']}}</span></div>

                    </div>
                        <br>
                @endforeach
            @endif
        </div>
        <div id="post-result">
            @if($post_num!=0)
                <p style="font-size: 25px">Posts</p><hr>
                @foreach($posts as $post)
                    <div class="card">
                        @if($post->profile_img!=null)
                        <div><img src="{{'/images/users_profile_img/'.$post->profile_img}}" id="userAvatar" class="m-2"><span>{{$post->first_name." ".$post->last_name}}</span></div>
                        @else
                            <div><img src="images/user_default.png" id="userAvatar">
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
</div>
</body>

<script type="text/javascript" src="resources/js/app.js"></script>
</html>
