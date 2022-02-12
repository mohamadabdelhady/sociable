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

<div class="login-photo ml-auto mr-auto" style="max-width: 400px !important;">
    <div class="form-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div id="logo-img"class="ml-auto mr-auto" ></div>

            <div class="form-group">
                <input type="firstname" class="form-control @if($errors->register_error->has('first_name')) is-invalid @endif" id="Inputusername"  placeholder="First name" name="first_name">
                @if($errors->register_error->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register_error->first('first_name') }}</strong>
                                    </span>
                                @endif

            </div>
            <div class="form-group">
                <input type="firstname" class="form-control @if($errors->register_error->has('last_name')) is-invalid @endif" id="Inputusername"  placeholder="Last name" name="last_name">
                                @if($errors->register_error->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register_error->first('last_name') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="form-group">
                <input type="email" class="form-control @if($errors->register_error->has('email')) is-invalid @endif" id="InputEmail"  placeholder="Email" name="email">
                @if($errors->register_error->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register_error->first('email') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="form-group">
                <label>Date of birth</label>

                <input type="date" class="form-control @if($errors->register_error->has('dob')) is-invalid @endif" id="Inputdob"  placeholder="" name="dob" value="dd/mm/yyyy">
                @if($errors->register_error->has('dob'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register_error->first('dob') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control @if($errors->register_error->has('password')) is-invalid @endif" id="InputPassword" placeholder="Password" name="password">
                @if($errors->register_error->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->register_error->first('password') }}</strong>
                                    </span>
                                @endif
            </div>

            <div class="form-group">
                <input type="password" class="form-control  " id="InputConfirmPassword" placeholder="Confirm password" name="password_confirmation">
            </div>
            <div class="btn-group btn-group-toggle form-group" data-toggle="buttons" name="gender" style="width: 100%;">
  <label class="btn btn-secondary active">
    <input type="radio" name="gender" id="male" autocomplete="off" checked value="male"> Male
  </label>
  <label class="btn btn-secondary">
    <input type="radio" name="gender" id="female" autocomplete="off" value="female"> Female
  </label>
</div>
            <div class="form-group mt-2"><button class="btn btn-block btn-log " type="submit">Sign up</button></div><a class="already" href="/">You alredy have an account? Log in here.</a>
        </form>
    </div>
</div>
</div>
</body>
</html>
