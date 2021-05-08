
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/popup.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style-post.css') }}" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-dark"id="nav-bar" >
	<div class="container-fluid" >
		<div class="navbar-brand" id="logo-img"></div>
		<form class="navbar-nav ml-auto mr-auto" id="Search-form">
   <input class="form-control " type="search" placeholder="Search" aria-label="Search" id="search-input" >
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
  	@if($prof_img!=null)
    <img src="{{url('/images/users_profile_img/'.$prof_img.'.png')}}" id="userAvatar"><span class="ml-3">{{$username}}</span>
    @else
    <img src="/images/user_default.png" id="userAvatar"><span class="ml-3">{{$username}}</span>
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
    	@if($prof_img!=null)
    <img src="{{url('/images/users_profile_img/'.$prof_img.'.png')}}" id="userAvatar">
    @else
    <img src="/images/user_default.png" id="userAvatar">
    @endif
            <span class="h5">What is on your mind {{$username}} </span>
            </div></a>
            <button id="crt-post" style="display: none" ></button>

  </div>
    </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="form">
                    <textarea class="form-control" id="textArea" rows="10" placeholder="text here"></textarea>
                    <div class="btn-group btn-group-sm m-2" role="group" aria-label="Second group">
                        <button type="button" class="btn btn-light"><img src="/picture_icon.png" id="home_icon"><p>Picture</p></button>
                        <button type="button" class="btn btn-light"><img src="/video_icon.png" id="home_icon"><p>Video</p></button>
                    </div>
                    <input type="button" class="btn btn-outline-info " style="width: 100%;" value="Post">
                </div>
            </div>

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
</body>
</html>
