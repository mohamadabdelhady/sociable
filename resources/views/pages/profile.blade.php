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
                @if(auth()->user()->profile_img)
                <img src="/storage/{{auth()->user()->profile_img}}">
                @else
                    <img src="/images/user_default.svg">
                @endif
                    <form id="profile-upload" action="upload/profile" method="POST"  style="display: none;" enctype="multipart/form-data">
                        @csrf
                        <input type="file"  directory  accept="image/*" style="display: none;" id="upload-prof" class="form-control" name="profile" onchange="document.getElementById('profile-upload').submit()">
                    </form>
                    <button class="btn" style="font-family:Arial, FontAwesome" title="change profile" onclick="document.getElementById('upload-prof').click();">&#xf3e0;</button>
                </div>
                <p class="users-name mt-2 m-auto">{{auth()->user()->first_name." ".auth()->user()->last_name}}</p>

            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
            <div class="cover-img">
                @if(auth()->user()->cover_img)
                    <img src="/storage/{{auth()->user()->cover_img}}">
                @else
                    <img src="/images/cover_default.png">
                @endif
                    <form id="cover-upload" action="upload/cover" method="POST"  style="display: none;" enctype="multipart/form-data">
                        @csrf
                        <input type="file"  directory  accept="image/*" style="display: none;" id="upload-cover" class="form-control" name="cover" onchange="document.getElementById('cover-upload').submit()">
                    </form>
                    <button class="btn" style="font-family:Arial, FontAwesome" title="change cover" onclick="document.getElementById('upload-cover').click();">&#xf03e;</button>
            </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3">
            <div class="card">

                <p class="m-auto users-name" style="font-size:x-large">Bio</p>
                <edit_user_bio :my_bio="{{json_encode(auth()->user()->bio)}}"></edit_user_bio>
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
            <user_posts></user_posts>
        </div>
        <div>

        </div>
    </div>
</div>
</body>
</html>
