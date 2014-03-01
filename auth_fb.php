<?php
session_start();
require_once ('inc/global_fns.php');
$access_token = $_GET['access_token'];
$zb_uid = $_SESSION['zb_uid'];

//Connect to db
$conn = db_connect ();
if (!$conn)
	die ('Could not connect to the database');

if(empty($_GET)){
	echo 'my ass';
}else{
	$json_url = 'https://graph.facebook.com/me/?access_token='.$access_token;
	$json = file_get_contents($json_url,0,null,null);
	$json_output = json_decode($json);	
	
	//Insert into the date base and return ID
	$sql = "INSERT INTO zambur_facebook (zb_uid, fb_uid, oauth_token, checked)
		VALUES ($zb_uid, $json_output->id, '$access_token', now( ))";
	
	echo $sql;
	
	$_SESSION['uid'] = $json_output->id;
	$_SESSION['access_token'] = $access_token;
	  

	if(!($result = mysql_query($sql)))
		echo ('Could not insert facebook db');
	else
		echo $access_token;
}
?>