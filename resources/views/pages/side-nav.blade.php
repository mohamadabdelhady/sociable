
    <div class="card">
        <div>
            @if(auth()->user()->profile_img&&auth()->user()->google_id)
                <img src="{{url(auth()->user()->profile_img)}}" class="userAvatar">
            @elseif(auth()->user()->profile_img)
                <img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" class="userAvatar">
            @else
                <img src="/images/users_profile_img/user_default.png" class="userAvatar">
            @endif
            <span class="ml-2 users-name">{{auth()->user()->first_name." ".auth()->user()->last_name}}</span>
        </div>
    </div>
    <div class="card mt-4">
        <a style="font-family:Arial, FontAwesome">&#xf015;<span class="ml-2">Home</span></a>
        <hr>
        <a style="font-family:Arial, FontAwesome">&#xf500;<span class="ml-2">Friends</span></a>
        <hr>
        <a style="font-family:Arial, FontAwesome">&#xf03e;<span class="ml-2">Profile</span></a>
        <hr>
        <a style="font-family:Arial, FontAwesome">&#xf013;<span class="ml-2">Settings</span></a>
    </div>
