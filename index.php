<?php
	if(!ob_start("ob_gzhandler")) ob_start(); //gzip-e-di-doo-da

	require_once 'uv/HelpFunctions.php';

	$urlz = $_SERVER['REQUEST_URI'];
	$urlz = substr($urlz, 1);
	$urlz = urlfix($urlz);

	// Try to remove http:// from bookmarklet and direct links.
	if (strpos($urlz, "unvis.") !== false) {header("Location: http://unvis.it", true, 303);}
	if(strpos($urlz, "http:") !== false) {
		$str = $urlz;
		$str = preg_replace('#^https?:/#', '', $str);
		header("Location: http://".$_SERVER['HTTP_HOST'].$str, true, 303);
	}

	require 'controller/cachecontroller.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php if ($urlz) { echo 'UV : '.$urlz;} else { echo "unvis.it – avoid endorsing idiots";} ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="stylesheet" type="text/css" media="screen" href="/uv/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/uv/css/bootstrap-theme.min.css" type="text/css" media="screen">
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/uv/img/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/uv/img/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/uv/img/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/uv/img/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="/uv/img/favicon.png">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script src="/uv/js/main.js" type="text/javascript"></script>
	<script type="text/javascript">
		window.google_analytics_uacct = "UA";
	</script>
</head>
<body>
	<div class="container">
		<div id="head">
			<div class="row">
				<br>
				<div class="col-md-2"></div>
				<div class="col-md-8" id="theInputForm">
					<form class="form-inline">
						<div class="form-group">
					    	<div class="input-group">
								<div class="input-group-addon"><a href="http://unvis.it" id="logo" ><strong>unvis.it/</strong></a> </div>
								<input class="form-control" type="text" name="u" id="uv" placeholder="Url you want to read without giving a pageview" value="<?php if ($urlz) { echo $urlz;} ?>" >
							</div>
						</div>
					</form>
					<hr>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		<?php
			if (count($errors) > 0) {
				require("view/errorview.php");
			}
			if($title && $body){
				require("view/cacheview.php");
			}
		?>
	</div>
	<div id="footer">
		<?php
			if (!$urlz) {
				require("view/frontpageview.php");
			}
		?>
	</div>
	<script type="text/javascript" src="/uv/js/bootstrap.min.js"></script>
</body>
</html>
