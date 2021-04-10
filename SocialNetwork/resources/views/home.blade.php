<!DOCTYPE html>
<html lang="en">

<head>
	<title>.Connect</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="{{ asset('js/script.js') }}" defer></script>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<div class="container-fluid" style="background: rgba(156,172,191,0.7); " id="background">
<body style="background: url('/images/hangout.jpg'); background-repeat: no-repeat;background-size: cover; ">
<nav class="navbar navbar-dark" id="nav-bar">
	<div class="container-fluid">
		<div class="navbar-brand" id="logo-img" style="background: url('/images/Connect-Logo.png');"></div>
	</div>
</nav>
	<div id="forms" class="row" style="min-width: 100%">
		<div class="col-xl-1 col-lg-1 col-md-1"></div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12" id="logintext"> 
		<h1 class="display2 ">Log In</h1>
		<p class="lead ">And be connected to the world.</p>
		<button class="btn btn-primary" onclick="displaysignup(2)" id="loginbtn">Log in</button>
	    </div>
	    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6" id="loginarea">
		<form class="card " id="loginform" method="POST" action="{{ route('login') }}">
			@csrf
			<div class="m-3">
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail" aria-describedly="email-help" placeholder="Email" name="email">
				@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			</div>

			<div class="m-3">
				<input type="password" class="form-control" id="InputPassword" aria-describedly="password-help" placeholder="Password" name="password">
				<p class=" m-1" ><a href="forgot-password" style="color: black; text-decoration: none;">Forgot your password ?</a></p>
			</div>
			
			<button type="submit" class="btn btn-primary">Log In</button>

		</form>

		<form class="card" id="signupform" method="POST" action="{{ route('register') }}">
			@csrf
			<div class="card-header h4">{{ __('Register') }}</div>
			<div class="m-3">
				<input type="firstname" class="form-control @error('first_name') is-invalid @enderror" id="Inputusername"  placeholder="First name" name="first_name">
				@error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

			</div>
			<div class="m-3">
				<input type="firstname" class="form-control @error('last_name') is-invalid @enderror" id="Inputusername"  placeholder="Last name" name="last_name">
				@error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			</div>
			<div class="m-3">
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail"  placeholder="Email" name="email">
				@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			</div>
			<div class="m-3">
				<input type="password" class="form-control @error('password') is-invalid @enderror" id="InputPassword" placeholder="Password" name="password">
				@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			</div>
			<div class="m-3">
				<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="InputConfirmPassword" placeholder="Confirm password" name="password_confirmation">
				@error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			</div>
			<button class="btn btn-primary" id="registerbtn" name="signup">Sign up</button>
		</form>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6" id="siguparea">
			<h1 class="display2 ">Don't have an account?</h1>
		<p class="lead ">Creat a new account and join our online community.</p>
			<button class="btn btn-primary" onclick="displaysignup(1)" id="signupbtn">Sign up</button>
					</div>
				</div>	
</body>
</div>
<footer style="background: rgba(156,172,191,0.7);padding-left: 1%;">.Connect© 2021 Copyright </footer>

</html>