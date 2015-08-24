<?php
	if(!ob_start("ob_gzhandler")) ob_start(); //gzip-e-di-doo-da

	require_once 'uv/HelpFunctions.php';

	// Try to remove http:// from bookmarklet and direct links.
	$urlz = $_SERVER['REQUEST_URI'];
	$urlz = substr($urlz, 1);
	$urlz = urlfix($urlz);

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
			if($title && $body){
				require("view/cacheview.php");
			}
		?>
	</div>
	<div id="footer">
		<?php if (!$urlz) {?>
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<h1 id="about">What is unvis.it?</h1>
					<p>Unvis.it is a tool to escape linkbaits, trolls, idiots and asshats. </p>
					<p>What the tool does is to try to capture the content of an article or blog post without passing on your visit as a pageview. Effectively this means that you're not paying with your attention, so you can <strong>read and share</strong> the idiocy that it contains.</p>
					<p><small>Now with a speed reading options from <a href="http://www.squirt.io/">Squirt</a>, so you can get dumbfounded quicker!</small></p>
					<br>
					<p><b>FAQ:</b>
						<ul>
							<li><b>Is this legal?</b> Probably not. </li>
							<li><b>Does it work with any website?</b> Certainly not. </li>
							<li><b>Do we track you?</b> Only through Google <del>Echelon</del> Analytics.</li>
							<li><b>Is it open source?</b> <a href="https://github.com/phixofor/unvis.it">Sure, why not?</a></li>
							<li><b>I heard someone made a Firefox add-on?</b> <a href="https://addons.mozilla.org/en-US/firefox/addon/unvisit/">Indeed!</a></li>
							<li><b>I need anonymous file hosting?</b> Check out <a href="http://minfil.org">Minfil.org</a></li>
						</ul>
					<p>Enjoy literally not feeding the trolls!</p>
					<br>
					<p style="text-align:center"> <a href="javascript:var orig%3Dlocation.href%3Bwindow.location.assign(%27http://unvis.it/%27%2Borig)%3B" class="btn btn-sm btn-info">Drag <b>this</b> to your bookmarks bar to unvis.it any page</a></p>
					<hr>
					<h2>Now: the same info in infographics</h2>
					<p style="text-align:center;"><img src="/uv/img/unvisit-xplaind.png" alt="What's this, I don't even…" title="What's this, I don't even…" ></p>
					<hr>
					<p style="text-align:center">
						<img src="/uv/img/icon_large.png" alt="OMG LOGOTYPE" title="OMG LOGOTYPE" style="width:150px;height:150px">
						<br><br><br>
						<?php //<a href="http://www.lolontai.re"><img src="/uv/img/lulz.png" id="lulz" alt="Sir Lulz-a-Lot approves" title="Sir Lulz-a-Lot approves"></a>?>
						<br><br><br><br><br><br><br><br>
					</p>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<?php } ?>
	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type="text/javascript" src="/uv/js/bootstrap.min.js"></script>
<script type="text/javascript" >
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
	</script>
</body>
</html>
