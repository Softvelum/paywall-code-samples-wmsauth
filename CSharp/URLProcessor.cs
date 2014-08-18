using System;
using System.Text;
using System.Security.Cryptography;
using System.Globalization;
 
public class URLProcessor
{
 
          public static string BuildProtectedURLWithValidity(string password, string media_url, string ip, int valid)
          {
              string result = null;
              DateTime cur_date = DateTime.Now;
              TimeZone localzone = TimeZone.CurrentTimeZone;
 
              DateTime localTime = localzone.ToUniversalTime(cur_date);
 
              string date_time = localTime.ToString(new CultureInfo("en-us"));
 
              Int32 Valid = valid;
              string to_be_hashed = ip + password + date_time + Valid.ToString();
 
              byte[] to_be_hashed_byte_array = new byte[to_be_hashed.Length];
 
              int i = 0;
              foreach (char cur_char in to_be_hashed)
              {  
                  to_be_hashed_byte_array[i++] = (byte)cur_char;
              }
 
              byte[] hash = (new MD5CryptoServiceProvider()).ComputeHash(to_be_hashed_byte_array);
 
              string md5_signature = Convert.ToBase64String(hash);
 
              string signature = "server_time=" + date_time + "&hash_value=" + md5_signature + "&validminutes=" + Valid.ToString();
              string base64urlsignature = Convert.ToBase64String(Encoding.UTF8.GetBytes(signature));
	      result = media_url + "?wmsAuthSign=" + base64urlsignature;
              return (result);
          }

	  public static void Main()
	  {
		Console.WriteLine(BuildProtectedURLWithValidity("defaultpassword", "http://127.0.0.1:1935/vod/sample.mp4/playlist.m3u8", "127.0.0.1", 20));
          }
}
