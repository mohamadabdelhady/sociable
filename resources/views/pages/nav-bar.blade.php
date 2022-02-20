<nav class="navbar" id="nav-bar">
    <div class="container-fluid">
        <a href="/"><div class="navbar-brand"></div></a>
<div  class="" style="display: inline-flex">
        <div class="search-bar me-3">
            <form class="navbar-nav" method="post" action="{{route('search-results')}}">@csrf
                <input class="form-control " type="search" placeholder="&#xF002; Search" aria-label="Search" id="search-input" name="q" style="font-family:Arial, FontAwesome">
            </form>
        </div>
              @if(auth()->user()->profile_img&&auth()->user()->google_id)
            <img src="{{url(auth()->user()->profile_img)}}" class="userAvatar">
        @elseif(auth()->user()->profile_img)
            <img src="{{url('/images/users_profile_img/' . auth()->user()->profile_img)}}" class="userAvatar">
        @else
            <img src="/images/users_profile_img/user_default.svg" class="userAvatar">
        @endif
    <button class="btn ms-2" style="font-family:Arial, FontAwesome">&#xf0f3;</button>
    <button class="btn ms-2" style="font-family:Arial, FontAwesome">&#xf107;</button>
</div>
    </div>
</nav>