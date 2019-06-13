Code snippets for WMSAuth Paywall feature set
=====================

WMSAuth Paywall is a feature set of WMSPanel which is the admin and reporting panel for media servers. This feature set can be applied to **Wowza Streaming Engine** (https://wmspanel.com/wowza) and **Nimble Streamer** (https://wmspanel.com/nimble). It allows restriction of your media access by:
- hot-linking re-publishing protection;
- geo-location and IP ranges;
- connections count.

Please read Paywall section of WMSPanel website for details: https://wmspanel.com/paywall

"pay-per-view" directory has reference code, requests and responses for pay-per-view feature set described in respective articles for Nimble Streamer and Wowza.

The following sample code snippets are provided for quick and seamless integration of hot-linking protection. The repository directories have the code as described below.

"CSharp" contains C# snippet.

"java" contains Java snippet.

"javascript" contains NodeJS JavaScript snippet.

"python" contains Python snippet.

"php" contains snippets for PHP:
- jwpayer-rtmp-hls.php - code sample for JWPlayer with RTMP and HLS
- jwpayer-rtmp-hls-with-proxy.php - code sample for JWPlayer with RTMP and HLS which has IP address obtained from various headers - see https://blog.wmspanel.com/2015/02/using-paywall-cloudflare-proxies.html for details.
- rtmp-flowplayer.php - Flowplayer sample with RTMP
- basic-hls-rtmp-obfuscation.php - basic sample for HLS and RTMP with code obfuscation agains grabbers, see this article for details: https://blog.wmspanel.com/2015/07/protecting-media-links-from-web-scraping.html
- basic-hls-stream-based.php - basic sample for HLS where signature includes streams name
- basic-rtsp.php - basic sample for RTSP
- ppv-rtsp-rtmp.php - sample of RTMP and RTSP signature for pay-per-view

If you look for code samples for Android or iOS, notice that we do not recommend using link signature code in mobile apps. Please read Q19 in paywall FAQ: https://wmspanel.com/paywall/faq 

You may also check publish control framework for managing streams publishers: https://blog.wmspanel.com/2015/10/rtsp-publish-control-framework-overview.html
