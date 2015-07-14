import org.apache.commons.codec.binary.Base64;
import org.apache.commons.codec.digest.DigestUtils;
import org.joda.time.DateTime;
import org.joda.time.DateTimeZone;
import org.joda.time.format.DateTimeFormat;
import org.joda.time.format.DateTimeFormatter;

import java.io.UnsupportedEncodingException;
import java.util.Locale;

public class Main {

	public static void main(String[] args) throws UnsupportedEncodingException {
	    DateTimeFormatter timeFormatter = DateTimeFormat.forPattern("M/d/y h:m:s a").withZone(DateTimeZone.UTC).withLocale(Locale.US);
		DateTime currentServerTime = new DateTime(DateTimeZone.UTC); // lets get localtime in UTC timezone
		String today = timeFormatter.print(currentServerTime);
		String initial_url = "http://yourdomain.com:8081/live";
		String video_url = "/Stream1";
   	    String ip = "127.0.0.1";
		String key = "defaultpassword";
		String validminutes = "20";

		String to_hash = ip + key + today + validminutes;
		byte[] ascii_to_hash = to_hash.getBytes("UTF-8");
		String base64hash = Base64.encodeBase64String(DigestUtils.md5(ascii_to_hash));
		String urlsignature = "server_time=" + today  + "&hash_value=" + base64hash + "&validminutes=" + validminutes;
		String base64urlsignature = Base64.encodeBase64String(urlsignature.getBytes("UTF-8"));
		String signedurlwithvalidinterval = initial_url + "?wmsAuthSign=" + base64urlsignature + video_url;

		return;
	}
}
