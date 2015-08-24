<div class="row">
    <div class="col-md-2">
        <!-- Speedreading -->
        <a href="javascript:(function(){sq=window.sq=window.sq||{};if(sq.script){sq.again();}else{sq.bookmarkletVersion='0.3.0';sq.iframeQueryParams={host:'//squirt.io',userId:'8a94e519-7e9a-4939-a023-593b24c64a2f',};sq.script=document.createElement('script');sq.script.src=sq.iframeQueryParams.host+'/bookmarklet/frame.outer.js';document.body.appendChild(sq.script);}})();" class="btn btn-default btn-mini hidden-phone" style="position: relative;top: 20px;" id="squirt">Speed read this</a>
    </div>
    <div id="theContent" class="col-md-8">
        <h1><?php echo $title; ?></h1>
        <a href='http://unvis.it/<?php echo $urlz; ?>' class='perma'><?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?></a>
        <hr>
        <?php echo $body; ?>
        <hr>
        <small><em><b>Source:</b> <a href="https://linkonym.appspot.com/?http://<?php echo $urlz; ?>"><?php echo $urlz; ?></a></em></small>
        <hr>

        <p style="text-align:center"><a href="/" class="btn btn-default" >What is unvis.it?</a></p>
        <br><br>
    </div>
    <div class="col-md-2"></div>
</div>
