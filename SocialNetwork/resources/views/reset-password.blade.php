
<!DOCTYPE html>
<html lang="en">

<head>
	<title>.Connect</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="{{ asset('js/app.js') }}" defer></script>
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
		<div class="col-xl-1 col-lg-1 col-md-1">
			
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12" id="logintext"> 
	    </div>
	    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6" id="loginarea">
		<form class="card " id="loginform" method="POST" action="{{ route('password.update') }}">
			<div class="card-header h4">{{ __('Set a new password') }}</div>
			@csrf
			<input type="hidden" name="token" value="{{$request->route('token')}}">
			<div class="m-3">
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail" aria-describedly="email-help" value="{{$request->email}}" name="email">
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
			<button type="submit" class="btn btn-primary">update</button>
		</form>
		</div>
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6" id="siguparea">
					</div>
				</div>	
</body>
</div>
<footer style="background: rgba(156,172,191,0.7);padding-left: 1%;">.Connect© 2021 Copyright </footer>

</html>