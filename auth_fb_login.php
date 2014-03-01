<?php
session_start();
$PHP_SELF = $_SERVER['PHP_SELF'];
require_once ('inc/global_fns.php');
do_html_header ('DB Connect Check');

$url = 'http://'.$_SERVER['SERVER_NAME'].'/hack/zambur/auth_fb_ajax.php';
//echo $url;
?>

    
<a href="javascript: void(0)" 
onclick="window.open('https://www.facebook.com/dialog/oauth?client_id=356592544411013&redirect_uri=<?php echo $url; ?>&scope=user_photos&response_type=token', 
'windowname1','width=900, height=300'); 
return false;">Connect your Facebook</a>
<?php
do_html_footer ();
?>