<!DOCTYPE html>
<?php


$nimble_host = "nimble.ultimatemediastreaming.com";
$id = "ID_1";
$ip = $_SERVER['REMOTE_ADDR'];
$password = "defaultpassword";
$app = "live";
$stream = "stream";

$stream_name ="/$app/$stream";
$str2hash = "$id$stream_name$password$ip";
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);

$urlsignature = "id=$id&sign=$base64hash&ip=$ip";

$base64urlsignature = base64_encode($urlsignature);

$rtmp_url = "rtmp://$nimble_host/$app?publishsign=$base64urlsignature/$stream";
$rtsp_url = "rtsp://$nimble_host/$app/$stream?publishsign=$base64urlsignature";

?>
<html>
<head>
</head>
<body>
<p>
    <b>RTMP publish signature</b>: <?=$rtmp_url?><br> 
    <b>RTSP publish signature</b>: <?=$rtsp_url?>
</p>
</body>
</html>
