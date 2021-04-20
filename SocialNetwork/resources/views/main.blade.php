
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
		<div class="navbar-brand" id="logo-img" style="background: url('/images/Connect-Logo.png');"></div>
		<div class="ml-5">
			<button class="btn">
		<img src="/home_icon.png" id="home_icon">
		</button>
		<button class="btn">
		<img src="/profile_icon.png" id="home_icon">
		</button>
	    </div>
		<form class="navbar-nav ml-auto mr-auto" id="Search-form">
   <input class="form-control " type="search" placeholder="Search" aria-label="Search" id="search-input" >
  </form>

  <div class="dropdown">
  <button class="btn dropdown-toggle mr-3" type="button" id="userlogindrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  	@if($prof_img!=null)
    <img src="{{url('/images/users_profile_img/'.$prof_img.'.png')}}" id="userAvatar"><span class="ml-3">{{$username}}</span>
    @else
    <img src="/images/user_default.png" id="userAvatar">{{$username}}
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
<div class="row container-fluid">
	<div class="col-xl-3 col-lg-3 " id="chat_area">
		<p class="mt-5" style="font-size: 30px;">Chat</p>
		<hr>
		<form class="" id="Search-chat">
   <input class="form-control " type="search" placeholder="Search" aria-label="Search" id="search-input" >
  </form>
  <p class="" style="font-size: 25px;">Online contacts</p>
  <div id="online_contacts" class="overflow-auto">
  	
  </div>
	</div>
	<div class="col-xl-6 col-lg-6" id="post_area">
		post
	</div>
	<div class="col-xl-3 col-lg-3" id="action_area">
		<p style="font-size: 25px;"class="mt-5">What is on your mind?</p>
		<hr>
		<button class="btn">
		<img src="/create_post_icon.png" id="user_icons"> <span class="ml-2">Creat a post</span>
		</button>
	
	</div>
</div>
</body>
</html>