<?php

/**
* 
*/

class functions
{

	public static function dateFormat($date, $format = 'M d, Y '/*G:i:s*/)
	{
		return date($format, strtotime($date));
	}

	public static function get_client_ip()
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function is_mail()
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL) ? true: false;
	}

	public static function is_empty($value)
	{
		return ! preg_match('/\S/', $value);
	}

	public static function n2M($n)
	{
		if($n==1) return 'January';
		elseif($n==2) return 'February ';
		elseif($n==3) return 'March';
		elseif($n==4) return 'April';
		elseif($n==5) return 'May';
		elseif($n==6) return 'June';
		elseif($n==7) return 'July';
		elseif($n==8) return 'August';
		elseif($n==9) return 'September';
		elseif($n==10) return 'October';
		elseif($n==11) return 'November';
		elseif($n==12) return 'December';
		else return('incorrect month number');
	}

	public function number_format_short( $n, $precision = 1 ) {
		if ($n < 900) {
			// 0 - 900
			$n_format = number_format($n, $precision);
			$suffix = '';
		} else if ($n < 900000) {
			// 0.9k-850k
			$n_format = number_format($n / 1000, $precision);
			$suffix = 'K';
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
		}
	  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
	  // Intentionally does not affect partials, eg "1.50" -> "1.50"
		if ( $precision > 0 ) {
			$dotzero = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}
		return $n_format . $suffix;
	}
}