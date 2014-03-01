<?php
session_start();
require_once ('inc/global_fns.php');

//User ID of logged in user
$user_id = $_GET['uid'];
$access_token = $_GET['access_token'];

function value_in_array($array, $find){
 $exists = FALSE;
 if(!is_array($array)){
   return;
}
foreach ($array as $key => $value) {
  if($find == $value){
       $exists = TRUE;
  }
}
  return $exists;
}


//Get all friends that are tagged in photos 
$friend_array = array();

$json_url = 'https://graph.facebook.com/'.$user_id.'/photos?access_token='.$access_token;
$json = file_get_contents($json_url,0,null,null);
$json_output = json_decode($json);

//Build List
$friend_list = array();
foreach($json_output->data AS $p) {	
	//Look at all the tags for this image
	foreach ($p->tags->data as $tag){
		if(!value_in_array($tag->id, $friend_list)){
			$friend_list[$tag->name] = $tag->id;
		}
	}
}

//Make it JSONish
$friend_array = array();

foreach($friend_list AS $key => $val) {	
	$friend_array[] = array('id' => $val, 'name' => $key);
}


$data_array = array('data' => $friend_array, 'paging' => $json_output->paging->next);

//Display the images
//foreach($friend_array AS $name){
	//echo $name.'</br>';
//}

//Create JSON String
$json = json_encode($data_array);
echo $json;
?>