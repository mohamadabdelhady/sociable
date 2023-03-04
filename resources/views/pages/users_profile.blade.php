<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df75158e35.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
@include('pages.nav-bar')
<div class="container-fluid" id="content">
    <div class="row">
        <div class="col-xl-1 col-lg-1">
        </div>
        <div class="col-xl-2 col-lg-2">
            <div class="card">
                <div class="profile_img">
                    @if($profile->profile_img)
                        <img src="/storage/{{$profile->profile_img}}">
                    @else
                        <img src="/images/user_default.svg">
                    @endif
                    @if($F_request==null&&$friend==null)
                            <button class="btn" style="font-family:Arial, FontAwesome" title="send friend request" onclick="send_friend_request({{$profile->id}})" id="req-btn">&#xf234;</button>
                        @elseif($friend==null)
                            <button class="btn" style="font-family:Arial, FontAwesome" title="Friend request sent" id="req-btn">&#xf4fc;</button>
                        @else
                            <button class="btn" style="font-family:Arial, FontAwesome" title="your friends">&#xf500;</button>
                    @endif
                     </div>
                <p class="users-name mt-2 m-auto">{{$profile->first_name." ".$profile->last_name}}</p>

            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="cover-img">
                    @if($profile->cover_img)
                        <img src="/storage/{{$profile->cover_img}}">
                    @else
                        <img src="/images/cover_default.png">
                    @endif
                    </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3">
            <div class="card over_flow">
            <p class="m-auto users-name" style="font-size:x-large">Bio</p>
                @if($bio->bio!=null)
                <p>{{$bio->bio}}</p>
                @else
                <p>{{$profile->first_name." ".$profile->last_name}}'s bio is empty.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-xl-3 col-lg-3">
        </div>
        <div class="col-xl-6 col-lg-6">
            <i style="font-family:Arial, FontAwesome;font-size: xx-large">
                &#xe29c;
            </i>
            <span style="float: right;font-size: xx-large">Time line</span>
            <hr>
            <user_posts :user_id="{{json_encode($id)}}"></user_posts>
        </div>
        <div>

        </div>
    </div>
</div>

<script>
   function send_friend_request(id)
    {
            axios.post('/send_friend_request', {friend_id: id})
                .then((res) => {
                    $('#req-btn').text('');
                    $('#req-btn').prop('title', 'remove from friends');
                })
                .catch((error) => {
                    console.log(error);
                });
    }
</script>
</body>
</html>
