<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
            for($i=0;$i<count($errors);$i++){
                echo '<div class="text-danger">'.$errors[$i]."</div>\n";
            }
        ?>
        <hr>
        <p style="text-align:center"><a href="/" class="btn btn-default" >What is unvis.it?</a></p>
    </div>
    <div class="col-md-2"></div>
</div>
