<?php
$today = gmdate("n/j/Y g:i:s A");
$ip = $_SERVER['REMOTE_ADDR'];
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
            file: "rtmp://streamserver.yourdomain.com/live?wmsAuthSign=<?="$base64urlsignature"?>/mp4:my-stream.sdp"
        },{
            file: "http://streamserver.yourdomain.com:1935/live/mp4:my-stream.sdp/playlist.m3u8/wmsAuthSign=<?="$base64urlsignature"?>"
        }]
    }],
    height: 480,
    width: 640,
    autostart: 'true'
});
</script>
