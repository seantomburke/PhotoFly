<?php

function do_html_header($title, $css = false) {
	$css = ($css) ? '<link rel=stylesheet href="css/' . $css . '" type="text/css" />' : '';
	$zb_uid = $_SESSION['zb_uid'];
	echo '
<!DOCTYPE html>
<html>
<head>
	<title>' . $title . $PHP_SELF . '</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel=stylesheet href="css/global.css" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script src="js/global.js" type="text/javascript"></script>
	' . $css . '
</head>
<body>
<div id="container">
<div id="header">
	<div id="header_content">';
	
	if (isset($_SESSION['logged_in'])){
		//echo '<span class="left"><b>Current SessionID='.$zb_uid.'</b> | <a href="logout.php">Logout</a></span>';
	}
	
echo '
		
	</div>
</div>
<div class="clear"></div>
<div id="content">';
} //End Header Number


//Begin footer
function do_html_footer() {
	echo '</div>
	<div class="clear"></div>
	<div id="footer">
	<div class="footer-content">
			<span>Site Links</span>
			<a href="index.php">Home</a> |
			<a href="contact.php">Contact</a> |
			<a href="signup.php">Sign Up</a>
	</div>
	
	<p class="footer-content">
					&copy; ' . date ( Y ) . ' DropSync
	</p>
	</div>
	
	</div>
	</body>
</html>';

} //End footer
?>
