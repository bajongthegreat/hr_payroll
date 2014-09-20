<?php

$GLOBALS['_byPassRole'] = [0,1];

function dateDiff($start, $end, $output_type) {

		$result = "";
		$ts1 = strtotime($start);
		$ts2 = strtotime($end);



		$seconds_diff = $ts2 - $ts1;

		switch ($output_type) {
			case 'months':
				$result = round($seconds_diff/2419200,0);
				break;
			case 'days':
				$result = round($seconds_diff/86400,0);
			break;

			case 'weeks':
			$result = round($seconds_diff/604800,0);
			break;

			case 'year':
			$result = round($seconds_diff/31536000,0);
			break;
			
			default:
				$result = $seconds_diff;
				break;
		}

		if ($result == 0 ) $result =1 ;
		

		return $result;
	}
function isDateValid($date) {
	if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
    {
        return true;
    }else{
        return false;
    }
}

function monthName($month_number) {
	$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','Novermber', 'December'];

	if ($month_number > 12  || $month_number < 1) {
		throw new Exception('Invalid month');
	}

	return $months[$month_number - 1 ];
}
