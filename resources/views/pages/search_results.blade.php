<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/df75158e35.js" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>
@include('pages.nav-bar')
<div class=" container-fluid"style="min-height: 100vh; width: 100%" id="content">

    <search_results :people="{{json_encode($people)}}"></search_results>
</div>
</body>
</html>
