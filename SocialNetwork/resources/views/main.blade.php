
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
	<!-- <form class="createPost post">

        <div class="partOne">
            @if($prof_img!=null)
    <img src="{{url('/images/users_profile_img/'.$prof_img.'.png')}}" id="userAvatar">
    		@endif
            <textarea placeholder="What do you think..?" class="text "></textarea>

        </div>
        <div class="partTwo">
            <ul class="action-lists">

                <li class="action-list">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="#4db3f6"
                                d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z">
                            </path>
                        </svg>
                    </a>
                </li>

                <li class="action-list">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                            <path fill="#71a257"
                                d="M450.6 153.6c-3.3 0-6.5.9-9.3 2.7l-86.5 54.6c-2.5 1.6-4 4.3-4 7.2v76c0 2.9 1.5 5.6 4 7.2l86.5 54.6c2.8 1.7 6 2.7 9.3 2.7h20.8c4.8 0 8.6-3.8 8.6-8.5v-188c0-4.7-3.9-8.5-8.6-8.5h-20.8zM273.5 384h-190C55.2 384 32 360.8 32 332.6V179.4c0-28.3 23.2-51.4 51.4-51.4h190c28.3 0 51.4 23.2 51.4 51.4v153.1c.1 28.3-23 51.5-51.3 51.5z">
                            </path>
                        </svg>
                    </a>
                </li>

                <li class="action-list">
                    <a>
                        <svg fill="#9d87d2" height="23" viewBox="0 0 24 24" width="23"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <defs>
                                <path d="M24 24H0V0h24v24z" id="a"></path>
                            </defs>
                            <clipPath id="b">
                                <use overflow="visible" xlink:href="#a"></use>
                            </clipPath>
                            <path clip-path="url(#b)"
                                d="M11.5 9H13v6h-1.5zM9 9H6c-.6 0-1 .5-1 1v4c0 .5.4 1 1 1h3c.6 0 1-.5 1-1v-2H8.5v1.5h-2v-3H10V10c0-.5-.4-1-1-1zm10 1.5V9h-4.5v6H16v-2h2v-1.5h-2v-1z">
                            </path>
                        </svg>
                    </a>
                </li>

                <li class="action-list">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                            <path fill="#ff3a55"
                                d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z">
                            </path>
                        </svg>
                    </a>
                </li>

                <li class="action-list">
                    <a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24">
                            <path fill="#f3c038"
                                d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M8.5,8C9.328,8,10,8.896,10,10	s-0.672,2-1.5,2S7,11.104,7,10S7.672,8,8.5,8z M12,18c-1.905,0-3.654-0.874-4.8-2.399l1.599-1.201C9.563,15.417,10.73,16,12,16	c1.27,0,2.436-0.583,3.2-1.601l1.6,1.201C15.653,17.126,13.904,18,12,18z M15.5,12c-0.828,0-1.5-0.896-1.5-2s0.672-2,1.5-2	S17,8.896,17,10S16.328,12,15.5,12z">
                            </path>
                        </svg>
                    </a>
                </li>


            </ul>
        </div>
    </form>

    <div class="post">
        <p class="welcomePar">Welcome in new feed... Say Hello! </p>
    </div> -->
    <div class="card">
    	<div class="card-body">
    	@if($prof_img!=null)
    <img src="{{url('/images/users_profile_img/'.$prof_img.'.png')}}" id="userAvatar">
    @else
    <img src="/images/user_default.png" id="userAvatar"><span class="ml-3">
    @endif

    <input class="m-2 post-input" type="search" placeholder="What is on your mind {{$username}}" aria-label="Search" id="search-input" style="
	width: 80%;" >
	 <div class="btn-group btn-group-sm me-2" role="group" aria-label="Second group">
    <button type="button" class="btn btn-light"><img src="/picture_icon.png" id="home_icon"><p>Picture</p></button>
    <button type="button" class="btn btn-light"><img src="/video_icon.png" id="home_icon"><p>Video</p></button>
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