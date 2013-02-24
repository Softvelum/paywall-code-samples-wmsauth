<?php 
include("wowza/settings.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>FLV player with chapter navigation using Flowplayer + wowza</title>
  <link rel="stylesheet" type="text/css" href="wowza/fp.min.css" />
  <script type="text/javascript" src="wowza/flowplayer-3.2.6.min.js"></script>
  <script type="text/javascript">
// <![CDATA[ */
  window.onload = function () {
    // note: $f.each() is provided by flowplayer.js

    var player,
        cuepoints = [],
        seekpos = 0, // seek target when player is not loaded
        chapters = document.getElementById("chapters").getElementsByTagName("div"),
        i = 0;

    function clearchapters() {
      $f.each(chapters, function () {
        this.className = "";
      });
    }

    function currentchapter(i) {
      clearchapters();
      chapters[i].className = "current";
    }

    // collect cuepoints from rel attributes of chapter elements
    $f.each(chapters, function () {
      cuepoints.push({
        time: parseInt(this.getAttribute("rel"), 10),
        index: i
      });
      i = i + 1;
    });

    player = $f("player", "wowza/flowplayer-3.2.7.swf", {
      plugins: {
        rtmp: {
        url: "wowza/flowplayer.rtmp-3.2.3.swf",
		netConnectionUrl: "<?PHP echo $signedurlwithvalidinterval ?>"
		  
		  
        }
      },
      clip: {
		url: flashembed.isSupported([9, 115]) ? "flv:242f/videoname" : "", //replace 'videoname' by the FLV filename (without the file extension)
        provider: "rtmp",
        scaling: "fit",
        onStart: function () {
          if (seekpos) {
            // player was loaded by clicking on chapter element
            this.seek(seekpos);
            seekpos = 0;
          } else {
            chapters[0].className = "current";
          }
        },
        onCuepoint: [cuepoints, function (clip, cue) {
          // highlight chapter corresponding to cuepoint index property
          currentchapter(cue.index);
        }],
        onSeek: function (clip, pos) {
          // highlight chapter of current position
          var i = -1;
          pos = pos * 1000;
          $f.each(cuepoints, function () {
            i = pos >= this.time ? i + 1 : i;
          });
          currentchapter(i);
        },
        onFinish: function () {
          clearchapters();
          this.unload();
        }
      }
    });

    $f.each(chapters, function () {
      var pos = parseInt(this.getAttribute("rel"), 10) / 1000;
      this.onclick = function () {
        if (!player.isLoaded()) {
          player.play();
          // store seek target for clip.onStart event
          seekpos = pos;
        } else {
          // seeking to 0 in paused state does not update "still image"
          // therefore seek to 1 in this case
          player.seek(player.isPaused() && pos === 0 ? 1 : pos);
        }
      };
    });
  };
  // ]]>
  </script>
</head>

<body>
 
    <p>&nbsp;</p>
<div id="player"><img src="play.png" width="83" height="83"></div>

<div id="wrap">
<div id="chapters">
<blockquote>
 
<div rel="0000">
  <p><strong>Chapter 1</strong></p></div>
<br>

<div rel="23000"><p>Chapter 1</p></div>
<div rel="83000"><p>Chapter 1</p></div>
<div rel="128000"><p>Chapter 1</p></div>
<div rel="229000"><p>Chapter 1</p></div>
<div rel="262000"><p>Chapter 1</p></div>
<div rel="313000"><p>Chapter 1</p></div>
</blockquote>


</div></div></body></html>
