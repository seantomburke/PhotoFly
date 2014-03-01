<?php
session_start();
require_once ('inc/global_fns.php');

//User ID of logged in user
$user_id = $_GET['uid'];
$access_token = $_GET['access_token'];
$friend_id = $_GET['fid'];

//Get All the photos where the user is tagged in
//All the photos
$image_array = array();
$url_og = 'https://graph.facebook.com/'.$user_id.'/photos?access_token='.$access_token;
$url = $url_og;

$limit = 25;
$value = 1;
$redirect = 1;

$finished = false;

while(!$finished){
	$until = getImages($url);
	if($until > 0 && count($image_array) < 20){
		$url = 	$url_og.'&limit='.$limit.'&value='.$value.'&redirect='.$redirect.'&until='.$until;
	}else {
		$finished = true;
	}
}

$data_array = array('data' => $image_array);

//Create JSON String
$json = json_encode($data_array);
echo $json;

function getImages($json_url){
	global $image_array;
	global $friend_id;
	
	//echo $json_url.'</br>';
	$until_val = 0;
	
	$json = file_get_contents($json_url,0,null,null);
	$json_output = json_decode($json);


	foreach($json_output->data AS $p) {	
		//Look at all the tags for this image
		foreach ($p->tags->data as $tag){
			if($tag->id == $friend_id){
				$image_array[] = array('source' => $p->source);
			}
		}
	}
	
	if($json_output->paging->next){
		$n = strrpos($json_output->paging->next, "=");	
		$until_val = substr($json_output->paging->next, $n+1);
	}
	
	return $until_val;
}

?>