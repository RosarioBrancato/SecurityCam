<?php

	function isDateSwiss($date) {
		$retVar = false;
		
		if(strlen($date) == 10) {
			$arr = explode('.', $date);
			if(sizeof($arr) == 3 ) {
				//Day
				$retVar = intval($arr[0]) >= 1 && intval($arr[0]) <= 31;
				//Month
				$retVar &= intval($arr[1]) >= 1 && intval($arr[1]) <= 12;
				//Year
				$retVar &= intval($arr[2]) >= 0 && intval($arr[2]) <= 9999;
			}
		}
		
		return $retVar;
	}

	function isTime($time) {
		$retVar = false;
		
		if(strlen($time) >= 5) {
			$arr = explode(':', $time);
			if(sizeof($arr) == 2 || sizeof($arr) == 3) {
				//Hours
				$retVar = intval($arr[0]) >= 0 && intval($arr[0]) <= 23;
				//Minutes
				$retVar &= intval($arr[1]) >= 0 && intval($arr[1]) <= 59;
			}
			if(sizeof($arr) == 3) {
				//Seconds
				$retVar &= intval($arr[2]) >= 0 && intval($arr[2]) <= 59;
			}
		}
		
		return $retVar;
	}

?>