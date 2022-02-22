    <a href="profile" class="rm_text_decoration" style="color: black;">
    <div class="card" >
        <div>
            @if(auth()->user()->profile_img)
                <img src="/storage/{{auth()->user()->profile_img}}" class="userAvatar">
              @else
                <img src="/images/user_default.svg" class="userAvatar">
            @endif
            <span class="ms-2 users-name">{{auth()->user()->first_name." ".auth()->user()->last_name}}</span>
        </div>
    </div>
    </a>
    <div class="card mt-4">

        <a style="font-family:Arial, FontAwesome">&#xf500;<span class="ms-2">Friends</span></a>
        <hr>
        <a style="font-family:Arial, FontAwesome">&#xf03e;<span class="ms-2">Photos</span></a>
        <hr>
        <a style="font-family:Arial, FontAwesome">&#xf008;<span class="ms-2">Videos</span></a>
    </div>
