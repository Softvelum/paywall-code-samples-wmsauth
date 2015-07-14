<?php
$today = gmdate("n/j/Y g:i:s A");

// URL of media we want to handle with pay-per-view
$initial_url = "http://video.wmspanel.com:8081/vod/sample.mp4/playlist.m3u8";

// client ID which is defined based on customer's database of users
$id = "5"; 
// A password entered in WMSAuth rule via web interface
$key = "defaultpassword"; 
// How long the link would be valid for playback
$validminutes = 240;

$str2hash = $id . $key . $today . $validminutes;
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);
$urlsignature = 
  'server_time=' . $today . '&hash_value=' . $base64hash . 
  '&validminutes=' . $validminutes . '&id=' . $id;
$base64urlsignature = base64_encode($urlsignature);
$signedurlwithvalidinterval = $initial_url . "?wmsAuthSign=$base64urlsignature";

// New protected media URL
echo $signedurlwithvalidinterval;
?>
