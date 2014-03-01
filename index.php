<?php 
session_start();
$url = 'http://'.$_SERVER['SERVER_NAME'].'/hack/PhotoFly/auth_fb_ajax.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=1024" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>PhotoFly!</title>
    
    <meta name="description" content="Happy Birthday Liz. I made you this gift just for you :)" />
    <meta name="author" content="Sean Burke & Jorge Zamora" />

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:regular,semibold,italic,italicsemibold|PT+Sans:400,700,400italic,700italic|PT+Serif:400,700,400italic,700italic" rel="stylesheet" />

    <link href="css/impress-demo.css" rel="stylesheet" />
    <link href="css/global.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
    <link rel="apple-touch-icon-precomposed" href="img/PBlogo-icon.png"/>
    <link rel="apple-touch-startup-image" href="img/splash.jpeg" />
    <link rel="apple-touch-startup-image" sizes="768x1004" href="images/pbsplash-ipad.png" />
   <link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>	
    
</head>

<body class="impress-not-supported">

<div class="fallback-message" style="margin:300px 30% 400px 30%;">
   <p>Thinking......</p>
</div>

<div id="impress" data-transition-duration="2000">

<?php
if(!isset($_SESSION['uid'])){
	echo '
	<div class="step" data-x="0" data-y="0" data-z="0">
		<p class="logo">PhotoFly</p>
	 	<a href="javascript: void(0)" 
	onclick="window.open(\'https://www.facebook.com/dialog/oauth?client_id=356592544411013&redirect_uri='.$url.'&scope=user_photos&response_type=token\', 
	\'windowname1\',\'width=900, height=500\'); 
	return false;"><span class="right"><img src="img/fb_button.png" style="float:right;"></a></span>
	</div>';

}
?>

<div class="step" data-x="2000" data-y="0" data-z="0" data-rotate-y="25">
	 	 <form id="search" action="show.php" method="get">
	 	 	<select id="combobox" name="fid">
	 	 		<option value="">Select a Friend</option>
	 	 <?php
	 	 
	 	 $url = 'http://www.seantburke.com/hack/PhotoFly/fb_json_friends.php?uid='.$_SESSION['uid'].'&access_token='.$_SESSION['access_token'];	 	 
	 	 var_dump($_SESSION);
	 	 
	 	 $temp = file_get_contents($url,'POST');
	 	 $array = json_decode($temp);
	 	 $next_url = $array->paging;
	 	 $paging = true;
	 	 foreach($array->data as $row){
	 	 	echo '<option value="'.$row->id.'">'.$row->name.'</option>';		
	 	 }
	 	 ?>
	 	 </select>
	 	 </form>
	 	 <span class="logout"><a href="https://www.facebook.com/logout.php?next=<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/hack/PhotoFly/logout.php';?>&access_token=<?php echo $_SESSION['access_token'];?> ">Logout Facebook</a></span>
</div>
	
	<script>
	if ("ontouchstart" in document.documentElement) { 
	    document.querySelector(".hint").innerHTML = "<p>Tap on the left or right to navigate</p>";
	}
	</script>

<script src="js/impress.js"></script>
<script src="js/jquery.js"></script>

<script>
	var api = impress();
	api.init();
	
	function start(){
		api.goto("start");
	}
</script>


<script>
	$("#combobox").change(function () {
		$("#search").submit();
	});
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





<!--
    
    The `impress()` function also gives you access to the API that controls the presentation.
    
    Just store the result of the call:
    
        var api = impress();
    
    and you will get three functions you can call:
    
        `api.init()` - initializes the presentation,
        `api.next()` - moves to next step of the presentation,
        `api.prev()` - moves to previous step of the presentation,
        `api.goto( idx | id | element, [duration] )` - moves the presentation to the step given by its index number
                id or the DOM element; second parameter can be used to define duration of the transition in ms,
                but it's optional - if not provided default transition duration for the presentation will be used.
    
    You can also simply call `impress()` again to get the API, so `impress().next()` is also allowed.
    Don't worry, it wont initialize the presentation again.
    
    For some example uses of this API check the last part of the source of impress.js where the API
    is used in event handlers.
    
-->

</body>
</html>
