<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/script.js') }}" defer></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/loginstyle.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid" style="background-color: #f1f7fc; min-height: 100vh;">
	
<div class="login-photo">
    <div class="form-container">
        <div class="image-holder"></div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div id="logo-img"class="ml-auto mr-auto" ></div>
           
            <div class="form-group"><input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
            <div class="form-group"><input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <p class=" m-1" ><a href="forgot-password" style="color: black; text-decoration: none;">Forgot your password ?</a></p></div>
            <div class="form-group"><button class="btn btn-block btn-log" type="submit">Log in</button></div><a class="already" href="signup">Dont have an account? Sign up here.</a>
        </form>
    </div>
</div>
</div>
</body>
</html>