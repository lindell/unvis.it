$(document).ready(function() {
    $("#uv").change(function() {
        theURL = $("#uv").val();
        theURL = theURL.replace(/.*?:\/\//g, "");
        theURL = decodeURIComponent(theURL);
        $("#uv").val(theURL);
    });

    $("#uv").click(function() {
        $(this).select();
    });

    function leSwitcheroo(){
        var orig=$("#uv").val();
        var urlz=location.host;
        location.replace("http://"+urlz+"/"+orig);
    };

    $("#uv").keyup(function(event){
        if(event.keyCode == 13){
            leSwitcheroo()
        }
    });

    $('.toplistLink a').on('click', function() {
        var a_href = $(this).attr('href');
        ga('send', 'event', 'toplist', 'click', a_href);
    });
    $('a#squirt').on('click', function(){
        ga('send', 'event', 'article', 'click', "squirt");
    });
});
