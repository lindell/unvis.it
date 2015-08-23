<?php
    //Removes the http(s) and www part of an url
    function urlfix($url) {
        preg_match("/^(https?:\/\/)?(www.)?(.*)$/i", $url, $matches);

        //Ensure that nothing crazy happend
        if(!empty($matches[3])){
            return $matches[3];
        }
        return $url;
    }
?>