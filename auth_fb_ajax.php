<?php 
session_start();
?>
<html>
<head>
<script type="text/javascript">
function load(){
	var xmlhttp=new XMLHttpRequest();

	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
    		document.getElementById("result").innerHTML=xmlhttp.responseText;
  		}
	}
	//Get the auth token from the respond URL
	var url = document.URL;
	var from = url.indexOf("=");
	
	var auth_token = url.substring(from+1, url.length);
	//alert(auth_token);
	window.opener.location.reload(true);
	window.opener.location.replace("http://www.seantburke.com/hack/PhotoFly/#step-2");

	window.close();
	
	xmlhttp.open("GET","auth_fb.php?access_token="+auth_token,true);
	xmlhttp.send();
}
</script>
</head>
<body onload="load()">
<div id="result"></div>
</body>
</html>