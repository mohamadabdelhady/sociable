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



<div class="login-photo ms-auto me-auto" style="max-width: 400px !important;">
    <div class="form-container">
        <form method="POST" action="{{ route('password.request') }}">
            @csrf
            <div class="navbar-brand ms-auto me-auto" ></div>
            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail"  placeholder="Email" name="email">
                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="form-group"><button class="btn m-2 btn-block btn-log" type="submit">Reset pssword</button></div><a class="already" href="/">You alredy have an account? Log in here.</a>
        </form>
         @if(session('status'))
            <script type="text/javascript">alert("{{session('status')}}");</script>
            @endif
    </div>
</div>
</div>
</body>
</html>
