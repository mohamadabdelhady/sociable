var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("crt-post");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
    document.getElementById('error-upload').style.display='none';
    document.getElementById('textArea').value = "";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";

}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal


// Get the <span> element that closes the modal
var span2 = document.getElementById("close-btn");

// When the user clicks on the button, open the modal
// btn2.onclick = function() {
//     modal2.style.display = "block";

function get_sentiment(post_id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let id = post_id;
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "get_post_sentiment/"+id,
        type: "GET",
        success: function (response) {

            let positive=0;
            let negative=0;
            let neutral=0;
            if (response) {
                for (var i=0;i<response.length;i++){
                    var temp=response[i];
                    if(temp['Sentiment_class']=="positive")
                        positive++;
                    else if(temp['Sentiment_class']=="negative")
                        negative++;
                    else if(temp['Sentiment_class']=="neutral")
                        neutral++;
                }


            }
            document.getElementById("pos_num").innerHTML=" "+positive;
            document.getElementById("neg_num").innerHTML=" "+negative;
            document.getElementById("neut_num").innerHTML=" "+neutral;
 let sum=positive+negative+neutral;
 let one=350/sum;
 document.getElementById('span1').style.width=positive*one+"px";
            document.getElementById('span2').style.width=negative*one+"px";
            document.getElementById('span3').style.width=neutral*one+"px";
            modal2.style.display = "block";
        },
    });

}


// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";

}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}

