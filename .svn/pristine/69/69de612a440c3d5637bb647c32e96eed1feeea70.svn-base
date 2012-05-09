<?php
class TimeUtility {
	
	const ROUND_BY = 30;
	
	public static function round($round_by, $value) {
		$remainder = $value % $round_by;
		$half = $round_by / 2;
		$factor = floor($value / $round_by);

		if ($remainder >= $half) {
			return $round_by * $factor + $round_by;
		} else {
			return $round_by * $factor;
		}
	}

	//calculates difference in minutes between two time strings
	public static function calc_time_diff($time1, $time2) {
		$time1 = strtotime($time1);
		$time2 = strtotime($time2);
		$difference = $time1 - $time2;
		$min_diff = $difference / (60);
		return $min_diff;
	}

	//converts time string to total minutes
	public static function time_to_minutes($time) {
		$unixtime = strtotime($time);
		$minutes = (int) date('i', $unixtime) + (int) date('G', $unixtime) * 60;
		return $minutes;
	}

	//hour:minutes am/pm format.  For things like time-in
	public static function round_time_gia($time) {
		$total_minutes = self::time_to_minutes($time);
		$total_minutes = self::round(self::ROUND_BY, $total_minutes);
		$minutes = $total_minutes % 60;
		$hours = floor($total_minutes / 60);
		$time = date('g:i a', strtotime("$hours:$minutes"));
		return $time;
	}

	//hours:minutes format.  For things like hours worked.
	public static function round_time_gi($time, $round_factor) {
		$minutes = self::time_to_minutes($time);
		$minutes = self::round($round_factor, $minutes);
		$time = self::minutes_to_time($minutes);
		return $time;
	}

	//g:i a, from dtatetime
	public static function datetime_to_time($datetime) {
		return date('g:i a', strtotime($datetime));
	}

	//converts total minutes to g:i
	public static function minutes_to_time($total_minutes) {
		$minutes = $total_minutes % 60;
		$hours = floor($total_minutes / 60);
		if ($minutes == 0) {
			$minutes = '00';
		}
		return "$hours:$minutes";
	}

	//from how date should be displayed to the user to what this page needs to work wtih db.
	public static function date_view_to_date_db($date) {
		return date('Y-m-d', strtotime($date));
	}

	//from  what this page needs to work with db to how date should be displayed to the user.
	public static function date_db_to_date_view($date) {
		return date('m/d/Y', strtotime($date));
	}

	//combine date and time to db datetime
	public static function date_and_time_to_datetime($date, $time) {
		$datetime = date('Y-m-d H:i:s', strtotime($date . ' ' . $time));

		return $datetime;
	}
}

?>
