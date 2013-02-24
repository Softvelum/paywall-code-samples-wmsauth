<?php
$today = gmdate("n/j/Y g:i:s A");
$initial_url = "rtmp://rtmp-server.com/242f/"; //enter your rtmp server here
$ip = $_SERVER['REMOTE_ADDR'];
$key = "XXXXXXXX"; //enter your key here
$validminutes = 20;
$str2hash = $ip . $key . $today . $validminutes;
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);
$urlsignature = "server_time=" . $today ."&hash_value=" . $base64hash. "&validminutes=$validminutes";
$base64urlsignature = base64_encode($urlsignature);
$signedurlwithvalidinterval = $initial_url . "?wmsAuthSign=$base64urlsignature";
?>
