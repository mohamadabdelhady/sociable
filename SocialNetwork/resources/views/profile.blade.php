
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
<div class="row container-fluid"style="min-height: 100vh; min-width: 100%" id="content_profile">
	<div class="col-xl-1 col-lg-1"></div>
	<div class="col-xl-10 col-lg-10" >
		<div class="container">
		@if($cover_img!=null)
    <img src="{{url('/images/user_cover_img/'.$cover_img.'.png')}}" id="cover"><!-- <span class="ml-3">{{$username}}</span> -->
    @else
    <img src="/images/user_cover_img/cover_default.png" id="cover"><!-- <span class="ml-3">{{$username}}</span> -->
    @endif
    <button class="btn btn-primary" id="editbtn">Edit</button>
</div>
	</div>
	<div class="col-xl-1 col-lg-1" id="action_area"></div>
</div>
</body>
</html>