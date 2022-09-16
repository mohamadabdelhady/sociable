    <a href="profile" class="rm_text_decoration" style="color: black;">
    <div class="card" title="profile" >
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
    <div class="mt-4">
    <contacts id="{{json_encode(auth()->id())}}"></contacts>
    </div>

