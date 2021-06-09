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
    <style>
        body{margin-top:100px;}

        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 800px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }
        .py-3 {
            padding-top: 1rem!important;
            padding-bottom: 1rem!important;
        }
        .px-4 {
            padding-right: 1.5rem!important;
            padding-left: 1.5rem!important;
        }
        .flex-grow-0 {
            flex-grow: 0!important;
        }
        .border-top {
            border-top: 1px solid #dee2e6!important;
        }
    </style>
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

                <a class="dropdown-item" href="#"><img src="/settings.png" id="user_icons"> <span class="ml-2">settings</span></a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><img src="/logout_icon.png" id="user_icons"> <span class="ml-2">log out</span></a>
                <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                    @csrf
                </form>


            </div>
        </div>
    </div>
</nav>
<main class="content">
    <div class="container p-0">



        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">

                    <div class="px-4 d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search...">
                            </div>
                        </div>
                    </div>

{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="badge bg-success float-right">5</div>--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="" class="rounded-circle mr-1" alt="Vanessa Tucker" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Vanessa Tucker--}}
{{--                                <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="badge bg-success float-right">2</div>--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="rounded-circle mr-1" alt="William Harris" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                William Harris--}}
{{--                                <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Sharon Lessman--}}
{{--                                <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="rounded-circle mr-1" alt="Christina Mason" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Christina Mason--}}
{{--                                <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar5.png" class="rounded-circle mr-1" alt="Fiona Green" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Fiona Green--}}
{{--                                <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="rounded-circle mr-1" alt="Doris Wilder" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Doris Wilder--}}
{{--                                <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="rounded-circle mr-1" alt="Haley Kennedy" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Haley Kennedy--}}
{{--                                <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">--}}
{{--                            <div class="flex-grow-1 ml-3">--}}
{{--                                Jennifer Chang--}}
{{--                                <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}

                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <img src="" class="rounded-circle mr-1" alt="" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 pl-3">
                                <strong></strong>
                                <div class="text-muted small"><em></em></div>
                            </div>
                            <div>
                                <button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
                            </div>
                        </div>
                    </div>

                    <div class="position-relative">
                        <div class="chat-messages p-4">


{{--                            <div class="chat-message-right mb-4">--}}
{{--                                <div>--}}
{{--                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">--}}
{{--                                    <div class="text-muted small text-nowrap mt-2">2:40 am</div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">--}}
{{--                                    <div class="font-weight-bold mb-1">You</div>--}}
{{--                                    Cum ea graeci tractatos.--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{-- <div class="chat-message-left pb-4">--}}
{{--                                <div>--}}
{{--                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">--}}
{{--                                    <div class="text-muted small text-nowrap mt-2">2:44 am</div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">--}}
{{--                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>--}}
{{--                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>

                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type your message">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
