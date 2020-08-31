#!/usr/bin/env python3
# coding: utf8

import base64
from hashlib import md5
from time import gmtime, strftime


def ppv_url_with_signature(ip, user_id, password, validminutes, initial_url, signed_stream="", strm_len=0):
    """
    Get URL with signature when using PayPerView method with Nimble
    :param ip: Viewer IP address
    :param user_id: User ID used in back-end web server
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
    key = (ip + user_id + password + today + validminutes + signed_stream).encode()
    m = md5(key)
    base64hash = base64.b64encode(m.digest())
    urlsignature = ("server_time=" + today + "&hash_value=" + base64hash.decode('utf-8') + "&validminutes=" +
                    validminutes + "&strm_len=" + str(strm_len) + "&id=" + user_id + "&checkip=true").encode()
    base64urlsignature = base64.b64encode(urlsignature)
    signedurlwithvalidinterval = initial_url + "?wmsAuthSign=" + base64urlsignature.decode('utf-8')
    return signedurlwithvalidinterval


def verify_ppv_signature(ppv_sync, token):
    """
    @param ppv_sync: ppv sync JSON sent by wmspanel
    @param token: Secret Token configured into WMS Panel push API
    @return: True if calculated signature == sent signature. Else, return False
    """
    try:
        sync_id = ppv_sync["ID"]
        puzzle = ppv_sync["Puzzle"]
        signature = ppv_sync["Signature"]
    except KeyError as error:
        raise KeyError(error)
    key = (sync_id + puzzle + token).encode()
    m = md5(key)
    base64hash = base64.b64encode(m.digest()).decode()
    if signature == base64hash:
        return True
    else:
        return False


def generate_ppv_solution(puzzle, token):
    """
    @param puzzle: 'Puzzle' value in JSON that is sent by nimble POST request
    @param token: Secret Token configured into WMS Panel push API
    @return: signature solution (string)
    """
    key = (puzzle + token).encode()
    m = md5(key)
    base64hash = base64.b64encode(m.digest()).decode()
    return base64hash
