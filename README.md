Code snippets for WMSAuth hot-linking protection
=====================

WMSAuth Paywall is a feature set of WMSPanel which is the admin and reporting panel for media servers. This feature set can be applied to **Wowza Streaming Engine** (https://wmspanel.com/wowza) and **Nimble Streamer** (https://wmspanel.com/nimble). It allows restriction of your media access by:
- hot-linking re-publishing protection;
- geo-location and IP ranges;
- connections count.

Please read Paywall section of WMSPanel website for details: https://wmspanel.com/paywall

Current sample code snippets are provided for quick and seamless integration of hot-linking protection.

- "CSharp" contains snippet for C# modofying RTSP stream URL
- "java" contains Java snippet for RTSP
- "javascript" has NodeJS JavaScript sample snippet
- "php" has snippet for PHP processing of RTSP URL
- "php-jwplayer" has a code which contains JWPlayer with HLS and RTMP streams. It also has example of PHP code for cases when your server works from behind the proxy.
- "php-rtmp-flowplayer" is a sample for flowpayer with RTMP stream
- "python" is obviously a Python sample
- "stream-signature" is an example of media stream signature with stream name in it
