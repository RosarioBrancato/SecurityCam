<?php

	include_once('surveillance/utils/DateTimeUtils.php');
	include_once('surveillance/bo/Filter.php');
	include_once('surveillance/bo/Video.php');
	include_once('surveillance/db/VideoDAO.php');
	include_once('surveillance/view/VideoGUI.php');

	$filter = new Filter();
	
	if(isset($_GET['date-from']) && strlen($_GET['date-from']) && isset($_GET['date-to']) && strlen($_GET['date-to']) && isDateSwiss($_GET['date-from']) && isDateSwiss($_GET['date-to'])) {
		$date_from = date('Y-m-d', strtotime($_GET['date-from']));
		$date_to = date('Y-m-d', strtotime($_GET['date-to']));
		
		if(isset($_GET['time-from']) && strlen($_GET['time-from']) && isset($_GET['time-to']) && strlen($_GET['time-to']) && isTime($_GET['time-from']) && isTime($_GET['time-to'])) {
			$time_from = date('H:i', strtotime($_GET['time-from']));
			$time_to = date('H:i', strtotime($_GET['time-to']));
			$filter->setValues($date_from, $date_to, $time_from, $time_to);
			
		} else {
			$filter->setValues($date_from, $date_to);
		}
	}
	
	$dao = new VideoDAO();
	$gui = new VideoGUI();
	
	$data = $dao->getVideos($filter);
	echo $gui->getGUI($filter, $data);
	
?>