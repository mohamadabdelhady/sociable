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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

<div class=" container-fluid"style="min-height: 100vh; width: 100%" id="content">
    <div class="row">
        <div class=" col-xl-4 col-lg-4">
            <div id="mySidemenu" class="sidemenu">
                <div class="" id="logo-img"></div>
                <br>
                <p class="m-4  h4" >Sentimental analysis panel</p>
                <br>
                <p class="m-4  h4">Get the sentiment for:-</p>
                <a href="#" id="all-link" onclick="event.preventDefault(); document.getElementById('all').click();"><span>All comments</span></a>
                <button style="display: none" id="all"></button>
                <a href="#" id="user-link"  onclick="event.preventDefault(); document.getElementById('post').click();"><span>search by post content</span></a>
                <button style="display: none" id="post"></button>
                <a href="#" id="post_link" onclick="event.preventDefault(); document.getElementById('comment').click();"><span>search by comment content</span></a>
                <button style="display: none" id="comment"></button>
            </div>

        </div>
        <div class="col-xl-4 col-lg-4">
        <div id="all_panel" >
            <div class="card">
                <p class="m-2 h4">Get the sentiment of all comments</p>
                <br><br>
                <button class="btn btn-primary" id="get_all">GO</button>
                <div id="results_all" class="m-2" style="display:none;">
                    <hr>
                    <p class="h3">results</p><br>
                    <p style="color: green;">positive :<span id="pos_num"></span></p>
                    <p style="color: red;">negative :<span id="neg_num"></span></p>
                    <p style="color:grey;">neutral :<span id="neut_num"></span></p>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <div class="chart has-fixed-height" id="pie_basic"></div>
                </div>
            </div>
        </div>
            <div style="display:none;" id="post_panel"><div class="card">
                    <p class="m-2 h5">Get the sentiment of all comments on post that contain specific words</p>
                    <br><br>
                    <input type="text" class="form-control m-2" style="width: 96%;" placeholder="search words">
                    <button class="btn btn-primary">GO</button>
                    <div id="results_all" class="m-2" style="display:none;">
                        <hr>
                        <p class="h3">results</p><br>
                        <p style="color: green;">positive :<span id="pos_num"></span></p>
                        <p style="color: red;">negative :<span id="neg_num"></span></p>
                        <p style="color:grey;">neutral :<span id="neut_num"></span></p>
                    </div>
                </div>
            </div>
            <div style="display:none;" id="comment_panel">
                <div class="card">
                <p class="m-2 h5">Get the sentiment of all comments that contain specific words</p>
                <br><br>
                    <input type="text" class="form-control m-2" style="width: 96%;" placeholder="search words">
                <button class="btn btn-primary">GO</button>
                    <div id="results_all" class="m-2" style="display:none;">
                        <hr>
                        <p class="h3">results</p><br>
                        <p style="color: green;">positive :<span id="pos_num"></span></p>
                        <p style="color: red;">negative :<span id="neg_num"></span></p>
                        <p style="color:grey;">neutral :<span id="neut_num"></span></p>
                    </div>
            </div>
        </div>
    </div>

</div>

<script>
    var btn_all = document.getElementById("all");
    var btn_post = document.getElementById("post");
    var btn_comment = document.getElementById("comment");
    btn_all.onclick = function() {
        document.getElementById('all_panel').style.display='block';
        document.getElementById('post_panel').style.display='none';
        document.getElementById('comment_panel').style.display='none';
    }
    btn_post.onclick = function() {
        document.getElementById('all_panel').style.display='none';
        document.getElementById('post_panel').style.display='block';
        document.getElementById('comment_panel').style.display='none';
    }
    btn_comment.onclick = function() {
        document.getElementById('all_panel').style.display='none';
        document.getElementById('post_panel').style.display='none';
        document.getElementById('comment_panel').style.display='block';
    }
    var get_all_btn=document.getElementById('get_all');
    get_all_btn.onclick = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{route('get_all_sent')}}",
            type: "GET",
            success: function (response) {

                let postive=0;
                let negative=0;
                let netural=0;
                if (response) {
                for (var i=0;i<response.length;i++){
                    var temp=response[i];
                    if(temp['Sentiment_class']=="positive")
                        postive++;
                    else if(temp['Sentiment_class']=="negative")
                        negative++;
                    else if(temp['Sentiment_class']=="neutral")
                        netural++;
                }
                    document.getElementById("pos_num").innerHTML=" "+postive;
                    document.getElementById("neg_num").innerHTML=" "+negative;
                    document.getElementById("neut_num").innerHTML=" "+netural;
                    document.getElementById("results_all").style.display="block";
                }
            },
        });
    }
</script>
</body>
</html>
