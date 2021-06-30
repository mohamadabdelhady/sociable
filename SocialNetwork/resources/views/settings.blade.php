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
<div class=" container-fluid"style="min-height: 100vh; width: 100%" id="content">
<div class="row">
<div class=" col-xl-4 col-lg-4">
    <div id="mySidemenu" class="sidemenu">
<p class="m-2 h4" >modify personal information</p>
    </div>

</div>
    <div class="col-xl-4 col-lg-4">

       <form method="POST" action="{{ route('user-profile-information.update') }}">
           @csrf
           @method('PUT')
        <div class="form-group">
            <label>First name</label>
            <input type="firstname" class="form-control @if($errors->updateProfileInformation->has('first_name')) is-invalid @endif" id="Inputusername"  placeholder="" value="{{auth()->user()->first_name}}" name="first_name">
            @if($errors->updateProfileInformation->has('first_name'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->updateProfileInformation->first('first_name') }}</strong>
                                    </span>
            @endif

        </div>
        <div class="form-group">
            <label>Last name</label>
            <input type="firstname" class="form-control @if($errors->updateProfileInformation->has('last_name')) is-invalid @endif" id="Inputusername"  value="{{auth()->user()->last_name}}" name="last_name">
            @if($errors->updateProfileInformation->has('last_name'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->updateProfileInformation->first('last_name') }}</strong>
                                    </span>
            @endif
        </div>
           <div class="form-group">
               <label>Email</label>
               <input type="email" class="form-control @if($errors->updateProfileInformation->has('email')) is-invalid @endif" id="InputEmail"  value="{{auth()->user()->email}}" name="email">
               @if($errors->updateProfileInformation->has('email'))
                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->updateProfileInformation->first('email') }}</strong>
                                    </span>
               @endif
           </div>
            <button class="btn btn-primary m-2" type="submit">Update information</button>
       </form>
        <hr>
        <form method="POST" action="{{route('user-password.update')}}">
            @csrf
            @method('PUT')
            <p>Change the password</p>
            <div class="form-group">
                <input type="password" class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif" id="InputPassword" placeholder="Current password" name="current_password">
                @if($errors->updatePassword->has('current_password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->updatePassword->first('current_password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">

                <input type="password" class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif" id="InputPassword" placeholder="Password" name="password">
                @if($errors->updatePassword->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->updatePassword->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control  " id="InputConfirmPassword" placeholder="Confirm password" name="password_confirmation">
            </div>
            <button class="btn btn-primary m-2" type="submit">Update password</button>
        </form>

    </div>
</div>
</div>
</body>
</html>
