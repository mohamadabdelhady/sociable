<nav class="navbar" id="nav-bar">
    <div class="container-fluid">
        <a href="/" title="Home"><div class="navbar-brand"></div></a>
<div  class="" style="display: inline-flex">
        <div class="search-bar me-3">
            <form class="navbar-nav" method="post" action="search">@csrf
                <input class="form-control " type="search" placeholder="&#xF002; Search" aria-label="Search" id="search-input" name="q" style="font-family:Arial, FontAwesome">
            </form>
        </div>
              @if(auth()->user()->profile_img)
            <img src="/storage/{{auth()->user()->profile_img}}" class="userAvatar">
        @else
            <img src="/images/user_default.svg" class="userAvatar">
        @endif
    <button class="btn ms-2" style="font-family:Arial, FontAwesome">&#xf0f3;</button>

    <div class="dropdown">
        <button class="btn dropdown-toggle ms-2 me-5" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" ></button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="srttings" style="font-family:Arial, FontAwesome">&#xf013; Settings</a></li>
            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a></li>
            <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</div>
    </div>
</nav>
