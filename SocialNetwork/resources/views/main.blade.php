
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
		<!-- <div class="ml-5">
			<button class="btn mybtn" style="border: none;box-shadow: none;" onclick="event.preventDefault(); document.getElementById('home-form').submit();">
				<form action="{{route('main')}}" method="get" style="display: none;" id="home-form"></form>
		<img src="/home_icon.png" id="home_icon">
		</button>
		<button class="btn mybtn" style="border: none;box-shadow: none;" onclick="event.preventDefault(); document.getElementById('profile-form').submit();">
		<img src="/profile_icon.png" id="home_icon">
		</button>
		<form action="{{route('profile')}}" method="get" style="display: none;" id="profile-form"></form>
	    </div> -->
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
<div class="row container-fluid"style="background-color: #f1f7fc; min-height: 100vh;">
	<div class="col-xl-3 col-lg-3 ml-2" id="chat_area">
		
  </div>
	<div class="col-xl-6 col-lg-6" id="post_area">
		
	</div>
	<div class="col-xl-3 col-lg-3" id="action_area">
		
	
	</div>
</div>
</body>
</html>