<?php
$today = gmdate("n/j/Y g:i:s A");
$ip = $_SERVER['REMOTE_ADDR'];

$key = "your_password";

$validminutes = 20;
$str2hash = $ip . $key . $today . $validminutes;
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);
$urlsignature = "server_time=" . $today ."&hash_value=" . $base64hash. "&validminutes=$validminutes";
$base64urlsignature = base64_encode($urlsignature);

$rtmpbegin = "rtmp://live.example.com/application?wmsAuthSign=";
$rtmpend = "/stream";
$httpbegin = "http://live.example.com/application/stream/playlist.m3u8?wmsAuthSign=";

$rtmpbeginarray = str_split($rtmpbegin, 1);
$rtmpendarray = str_split($rtmpend, 1);
$httpbeginarray = str_split($httpbegin, 1);
$signaturearray = str_split($base64urlsignature, 3);
$fakesignaturearray = str_split($base64urlsignature, 3);

$getrtmptitle = str_shuffle("getRtmpUrl");
$gethttptitle = str_shuffle("getHttpUrl");
$signaturetitle = str_shuffle("baseUrlSignatureArray");
$fakesignaturetitle = str_shuffle("beseUrlSignatureArray");

$count1 = mt_rand(3, 10);
$count2 = mt_rand(3, 10);
?>

<script type="text/javascript">
<?php
    for($i = 0; $i < $count1; $i++) {
        shuffle($fakesignaturearray);
        echo("var " . str_shuffle($fakesignaturetitle) . " = " . json_encode($fakesignaturearray) . ";\n");
    }
?>
var <?php echo($signaturetitle); ?> = <?php echo(json_encode($signaturearray)); ?>;
<?php
    for($i = 0; $i < $count2; $i++) {
        shuffle($fakesignaturearray);
        echo("var " . str_shuffle($fakesignaturetitle) . " = " . json_encode($fakesignaturearray) . ";\n");
    }
?>
    var test = {
        rtmp: <?php echo($getrtmptitle . "()"); ?>,
        http: <?php echo($gethttptitle . "()"); ?>
    };
	
    function <?php echo($getrtmptitle . "()"); ?> {
        return(<?php echo(json_encode($rtmpbeginarray)); ?>.join("") + <?php echo($signaturetitle); ?>.join("") + <?php echo(json_encode($rtmpendarray)); ?>.join(""));
    }
	
    function <?php echo($gethttptitle . "()"); ?> {
        return(<?php echo(json_encode($httpbeginarray)); ?>.join("") + <?php echo($signaturetitle); ?>.join(""));
    }
    alert(test.http);
    alert(test.rtmp);
</script>