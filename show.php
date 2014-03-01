<?php session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1024" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>PhotoFly</title>
    
    <meta name="description" content="PhotoFly Let's you share photos in 3D" />
    <meta name="author" content="Sean Burke & Jorge Zamora" />

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:regular,semibold,italic,italicsemibold|PT+Sans:400,700,400italic,700italic|PT+Serif:400,700,400italic,700italic" rel="stylesheet" />

    <link href="css/impress-demo.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
    <link rel="apple-touch-icon-precomposed" href="img/PBlogo-icon.png"/>
    <link rel="apple-touch-startup-image" href="img/splash.jpeg" />
    <link rel="apple-touch-startup-image" sizes="768x1004" href="images/pbsplash-ipad.png" />
    <link type="text/css" href="js/jquery-ui/css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
    <link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
</head>

<body class="impress-not-supported">

<div class="fallback-message">
    <p>Loading...</p><img src="img/loadery.gif" width="200px">
</div>

<audio autoplay="true">
  <source src="img/ecstasy.mp3" type="audio/mp3" />
</audio>

<div id="impress" data-transition-duration="2000">

<?php
	$access_token = $_SESSION['access_token'];
	$fbid = $_SESSION['uid'];
	$fid = $_GET['fid'];

	$url = 'http://www.seantburke.com/hack/PhotoFly/fb_json.php?uid='.$fbid.'&fid='.$fid.'&access_token='.$access_token;
	$temp = file_get_contents($url,'POST');
	$temp = stripslashes($temp);
	$array = json_decode($temp);
	$next_url = $array->paging;

	if(is_array(@$array->data))
	{
	
		foreach($array->data as $image)
		{
		echo ' <div class="step" data-x="'.$x.'" data-y="'.$y.'" data-z="'.$z.'">
			     <img src="'.$image->source.'"><p></p>
				</div>';
				$x = 1000*sin($z*.5);
				$y = 1000*cos($z*.5);
				$z -= 2000;
		}
	}
	
	echo ' <div class="step" data-x="'.$x.'" data-y="'.$y.'" data-z="'.$z.'"  data-rotate-y="180">
		     <a href="http://www.seantburke.com/hack/PhotoFly/#step-2">Try Another Friend</a>
			</div>';

?>
	<script>
	if ("ontouchstart" in document.documentElement) { 
	    document.querySelector(".hint").innerHTML = "<p>Tap on the left or right to navigate</p>";
	}
	</script>
	

<script src="js/impress.js"></script>
<script>
	var api = impress();
	api.init();
	
	function start(){
		api.goto("start");
	}
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16638282-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html>