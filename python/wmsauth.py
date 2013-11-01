import base64
import md5
from time import gmtime, strftime


today = strftime("%m/%d/%Y %I:%M:%S %p", gmtime())
print(today)
ip = "127.0.0.1"
password = "defaultpassword"
validminutes = "10"
initial_url = "http://127.0.0.1:1935/vod/sample.mp4/playlist.m3u8"

m = md5.new()
m.update(ip + password + today + validminutes)

base64hash = base64.b64encode(m.digest())

urlsignature = "server_time=" + today + "&hash_value=" + base64hash + "&validminutes=" + validminutes

base64urlsignature = base64.b64encode(urlsignature)

signedurlwithvalidinterval = initial_url + "?wmsAuthSign=" + base64urlsignature

print(signedurlwithvalidinterval)
