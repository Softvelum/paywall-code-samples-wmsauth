#!/usr/bin/env python3
# coding: utf8

import base64
from hashlib import md5
from time import gmtime, strftime


def get_media_url_with_signature(ip, password, validminutes, initial_url, signed_stream="", strm_len=0):
    """
    Get URL with Hot-link protection signature
    :param ip: Viewer IP address
    :param password: hot-link protection password wonfigured in WMSPanel Auth Rule
    :param validminutes: Valid duration of the URL in minutes. After this time, the URL will not work
    :param initial_url: Full URL stream you want to protect
    :param signed_stream: stream name to make it unique for each stream
    https://blog.wmspanel.com/2014/10/stream-name-hotlink-protection.html
    You may also use part of the name if you need to protect streams by pattern !
    :param strm_len: len(signed_stream)
    :return: Signed URL
    """
    today = strftime("%m/%d/%Y %I:%M:%S %p", gmtime())
    key = (ip + password + today + validminutes + signed_stream).encode()
    m = md5(key)
    base64hash = base64.b64encode(m.digest())
    urlsignature = ("server_time=" + today + "&hash_value=" + base64hash.decode('utf-8') + "&validminutes=" +
                    validminutes + "&strm_len=" + str(strm_len)).encode()
    base64urlsignature = base64.b64encode(urlsignature)
    signedurlwithvalidinterval = initial_url + "?wmsAuthSign=" + base64urlsignature.decode('utf-8')
    return signedurlwithvalidinterval

