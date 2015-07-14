<?php
/*
This is a sample code for adding WMSAuth paywall signature to RTMP and HLS streams.
The player is JWPlayer.

The IP address is obtained via any available header.
This includes headers from proxies and CloudFront.

For RTMP, the signature is inserted after application name.
For HLS,  the signature is inserted at the end of the URL
*/

$today = gmdate("n/j/Y g:i:s A");

$ip = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
    $ip = $_SERVER['HTTP_X_REAL_IP'];
} elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $commapos = strrpos($ip, ',');
    $ip = trim( substr($ip, $commapos ? $commapos + 1 : 0) );
}

$key = "defaultpassword";
$validminutes = 20;
$str2hash = $ip . $key . $today . $validminutes;
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);
$urlsignature = "server_time=" . $today ."&hash_value=" . $base64hash. "&validminutes=$validminutes";
$base64urlsignature = base64_encode($urlsignature);
?>

<div id='my-video'></div>
<script type='text/javascript'>
jwplayer("my-video").setup({
    playlist: [{
        sources: [{
            file: "rtmp://streamserver.yourdomain.com/live?wmsAuthSign=<?php echo $base64urlsignature;?>/mp4:my-stream.sdp"
        },{
            file: "http://streamserver.yourdomain.com:1935/live/mp4:my-stream.sdp/playlist.m3u8?wmsAuthSign=<?php echo $base64urlsignature;?>"
        }]
    }],
    height: 480,
    width: 640,
    autostart: 'true'
});
</script>
