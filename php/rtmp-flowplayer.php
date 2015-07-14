<?php
/*
This is a sample code for adding WMSAuth paywall signature to RTMP VOD stream.
The player is Flowplayer.

In this example the source media is located at 
rtmp://server.test.com:1935/vod/mp4:sample.mp4
Flow player has the name split by 2 part. They are stored in respective variables below.
*/
$base_url = 'rtmp://server.test.com:1935/vod';
$video_url = 'mp4:sample.mp4';

$today = gmdate("n/j/Y g:i:s A");
$ip = $_SERVER['REMOTE_ADDR'];
$key = "default"; //enter your key here
$validminutes = 20;
$str2hash = $ip . $key . $today . $validminutes;
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);
$urlsignature = "server_time=" . $today ."&hash_value=" . $base64hash. "&validminutes=$validminutes";
$base64urlsignature = base64_encode($urlsignature);
?>

<!DOCTYPE html>
<html>
<head>
<!-- 1. jquery library -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://cdn.jquerytools.org/1.2.6/all/jquery.tools.min.js"></script>
<!-- 2. flowplayer -->
<script src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>

<style>
a.rtmp {
    display:block;
    width:640px;
    height:360px;
    margin:25px 0;
    text-align:center;
}

a.rtmp img {
    border:0px;
    margin-top:140px;
}

</style> 

</head>
<body>

<div class="box black">
<a class="rtmp" href="<?php echo $video_url; ?>" style="background-image:url(placeholder.jpg)">
   <img src="play_button.png" />
</a>
</div>

<script>
$(function() {

$f("a.rtmp", "http://releases.flowplayer.org/swf/flowplayer-3.2.16.swf", {
 
        // configure both players to use rtmp plugin
        clip: {
            provider: 'rtmp'
        },
 
        // here is our rtpm plugin configuration
        plugins: {
          rtmp: {
                url:"http://releases.flowplayer.org/swf/flowplayer.rtmp-3.2.12.swf",
                netConnectionUrl: '<?php echo "$base_url?wmsAuthSign=$base64urlsignature"; ?>/<?php echo $video_url; ?>'
          }
        }
 
});


});
</script>

</body></html>
