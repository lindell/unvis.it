<?php
    use Readability\Readability;
    require_once 'uv/Readability.php';
    require_once 'uv/JSLikeHTMLElement.php';

    $errors = array();
    $title = "";
    $body = "";

    include_once("dbhandler.php");
    $db = new DBHandler();
    $cache = $db->read($urlz);
    if (!$cache && $urlz){
        // User agent switcheroo
        $UAstrings = array(
            "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",
            "Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)",
            "Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)",
            "Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)"
        );

        $UAstring = $UAstrings[array_rand($UAstrings)];
        $UAstring = "User-Agent: ".$UAstring."\r\n";

        if ($_GET["u"]) {
            $url = urldecode($urlz);

            if (!preg_match('!^https?://!i', $url)) $url = 'http://'.$url;

            // Create a stream
            $opts = array(
              'http'=>array(
                'method'=>"GET",
                'header'=>$UAstring
              )
            );
            $context = stream_context_create($opts);
            $html = @file_get_contents($url, false, $context);
        }


        if($html){
            // PHP Readability works with UTF-8 encoded content.
            // If $html is not UTF-8 encoded, use iconv() or
            // mb_convert_encoding() to convert to UTF-8.

            // If we've got Tidy, let's clean up input.
            // This step is highly recommended - PHP's default HTML parser
            // often does a terrible job and results in strange output.
            if (function_exists('tidy_parse_string')) {
                $tidy = tidy_parse_string($html, array(), 'UTF8');
                $tidy->cleanRepair();
                $html = $tidy->value;
            }

            // give it to Readability
            $readability = new Readability($html, $url);

            // print debug output?
            // useful to compare against Arc90's original JS version -
            // simply click the bookmarklet with FireBug's
            // console window open
            $readability->debug = false;

            // convert links to footnotes?
            $readability->convertLinksToFootnotes = true;

            // process it
            $result = $readability->init();

            // does it look like we found what we wanted?
            if ($result) {
                $title = $readability->getTitle()->textContent;
                $body = $readability->getContent()->innerHTML;

                // if we've got Tidy, let's clean it up for output
                if (function_exists('tidy_parse_string')) {
                    $tidy = tidy_parse_string($body,
                        array('indent'=>true, 'show-body-only'=>true),
                        'UTF8');
                    $tidy->cleanRepair();
                    $body = $tidy->value;
                    $body = trim(preg_replace('/\s\s+/', ' ', $body));
                }

                $db->cache($urlz, $title , $body);
            }
            else{
                array_push($errors,"Looks like we couldn't find the content ¯\_(ツ)_/¯");
            }
        }
        else{
            array_push($errors,"Looks like we couldn't load the webpage ¯\_(ツ)_/¯");
        }
    }
    else{
        $title = $cache["title"];
        $body = $cache["body"];
    }
?>
