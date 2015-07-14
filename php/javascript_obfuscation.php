<?php
$today = gmdate("n/j/Y g:i:s A");
$ip = $_SERVER['REMOTE_ADDR'];
$key = "YOUR_PASSWORD";
$validminutes = 10;
$str2hash = $ip . $key . $today . $validminutes;
$md5raw = md5($str2hash, true);
$base64hash = base64_encode($md5raw);
$urlsignature = "server_time=" . $today ."&hash_value=" . $base64hash. "&validminutes=$validminutes";
$base64urlsignature = base64_encode($urlsignature);

$rtmpbegin = "rtmp://bestsite.my/mylive?wmsAuthSign=";
$rtmpend = "mystream";

$rtmpbeginarray = str_split($rtmpbegin, 1);
$rtmpendarray = str_split($rtmpend, 1);

$firstsigpart = substr($base64urlsignature, 0, -48); 
$lastsigpart = substr($base64urlsignature, -48);
$fakelastsigpart = substr($lastsigpart, 0);

$signaturearray = str_split($firstsigpart, 3);
$fakesignaturearray = str_split($firstsigpart, 3);

$getrtmptitle = str_shuffle("getRtmpUrl");
$getrtmpfiletitle = str_shuffle("getRtmpFile");
$shiftbacktitle = str_shuffle("shiftBackSignature");
$fakeshiftbacktitle = str_shuffle("shiftBeckSignature");
$signaturetitle = str_shuffle("baseUrlSignatureArray");
$fakesignaturetitle = str_shuffle("beseUrlSignatureArray");

$count1 = mt_rand(7, 15);
$count2 = mt_rand(7, 15);
?>

<?php
    for($i = 0; $i < $count1; $i++) {
        $fakelastsigpart = str_shuffle($fakelastsigpart);
        $fakeshiftbacktitle = str_shuffle($fakeshiftbacktitle);
        echo("<span style='display:none' id=" . $fakeshiftbacktitle . ">" . $fakelastsigpart . "</span>");
    }
    echo("<span style='display:none' id=" . $shiftbacktitle . ">" . $lastsigpart . "</span>");
    for($i = 0; $i < $count2; $i++) {
        $fakelastsigpart = str_shuffle($fakelastsigpart);
        $fakeshiftbacktitle = str_shuffle($fakeshiftbacktitle);
        echo("<span style='display:none' id=" . $fakeshiftbacktitle . ">" . $fakelastsigpart . "</span>");
    }
?>

<div id="mediaspace">

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

    jwplayer("mediaspace").setup({
        flashplayer: "player.swf",
        width: '468',
        height: '380',
        allowfullscreen: 'true',
        allowscriptaccess: 'always',
        streamer: <?php echo($getrtmptitle . "()"); ?>,
        file: <?php echo($getrtmpfiletitle . "()"); ?>,
        repeat: 'always'
    });

    function <?php echo($getrtmptitle . "()"); ?> {
        return(<?php echo(json_encode($rtmpbeginarray)); ?>.join("") + <?php echo($signaturetitle); ?>.join("") + document.getElementById("<?php echo($shiftbacktitle); ?>").innerHTML);
    }

    function <?php echo($getrtmpfiletitle . "()");?> {
        return(<?php echo(json_encode($rtmpendarray)); ?>.join(""));
    }

</script>
