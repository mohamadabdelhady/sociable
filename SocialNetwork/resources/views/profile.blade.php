
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
		@if(auth()->user()->cover_img!=null)
    <img src="{{url('/images/user_cover_img/'.auth()->user()->cover_img)}}" id="cover">
    @else
    <img src="/images/user_cover_img/cover_default.png" id="cover">
    @endif

        <div class="dropdown editbtn">
            <button class="btn btn-light ml-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Edit cover
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
  <div class="btn-group btn-group-lg m-2 btn-cover" role="group" aria-label="Second group">
    <button type="button" class="btn btn-light"><img src="/timeline_icon.png" id="home_icon"><p>Timeline</p></button>
    <button type="button" class="btn btn-light"><img src="/following_icon.png" id="home_icon"><p>Follow</p></button>
    <button type="button" class="btn btn-light"><img src="/followers_icon.png" id="home_icon"><p>Followers</p></button>
</div>
	</div>
</div>
	<div class="col-xl-1 col-lg-1" id="action_area"></div>
</div>
</body>
</html>
