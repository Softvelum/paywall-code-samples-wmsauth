<?php
/*
This is a sample code for adding WMSAuth paywall signature to RTSP stream.
For RTSP, the signature is inserted after application name.
*/

$today = gmdate("n/j/Y g:i:s A");
 
$initial_url = "rtsp://ec2-test-ip.compute.amazonaws.com:1935/live";
$video_url = "/Stream1";

$ip = $_SERVER['REMOTE_ADDR'];
$key = "defaultpassword";
 
$validminutes = 20;
 
$str2hash = $ip . $key . $today . $validminutes;
 
$md5raw = md5($str2hash, true);
 
$base64hash = base64_encode($md5raw);
 
$urlsignature = "server_time=" . $today ."&hash_value=" . $base64hash. "&validminutes=$validminutes";

$base64urlsignature = base64_encode($urlsignature);

$signedurlwithvalidinterval = $initial_url . "?wmsAuthSign=$base64urlsignature" . $video_url;
 
?>
