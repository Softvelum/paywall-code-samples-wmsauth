Code snippets of WMSAuth hot-linking protection for Wowza
=====================

WMSAuth is a feature set for WMSPanel, the admin and reporting panel for Wowza. This set allows restriction of your media access by:
- connections count;
- geo-location and IP ranges;
- hot-linking re-publishing protection.

Read more about it in this blog post: http://blog.wmspanel.com/2012/09/wowza-geo-ip-range-connections-lock.html

Current sample code snippets are provided for quick and seamless integration of hot-linking protection.

- "CSharp" contains snippet for C# modofying RTSP stream URL
- "java" contains Java snippet for RTSP
- "php" has snippet for PHP processing of RTSP URL
- "php-jwplayer" has a snippet which contains JWPlayer with HLS and RTMP streams
- "php-rtmp-flowplayer" is a sample for flowpayer with RTMP stream

Please read the following posts describing this protection integration for your web site:
- http://blog.wmspanel.com/2012/05/protecting-wowza-from-re-publishing-re.html
- http://blog.wmspanel.com/2012/07/wmsauth-rtmp-protection-sample.html
- http://blog.wmspanel.com/2012/05/integrating-wmsauth-to-your-website.html


