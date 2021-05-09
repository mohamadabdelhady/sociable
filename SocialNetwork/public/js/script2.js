
    var el = document.getElementById('upload-img');
    el.onchange = function(){
        var fileType = document.getElementById('upload-img').files[0].type;
        var check= fileType.substring(0,5);
        if(check!="image"){
            document.getElementById('error-upload').innerHTML = 'you have to select images only';
            document.getElementById('error-upload').style.display='block';
        }
    };
    var el2 = document.getElementById('upload-video');
    el2.onchange = function()
    {
        var fileType = document.getElementById('upload-video').files[0].type;
        var check= fileType.substring(0,5);
        if(check!="video"){
            document.getElementById('error-upload').innerHTML = 'you have to select videos only';
            document.getElementById('error-upload').style.display='block';
        }
    }

