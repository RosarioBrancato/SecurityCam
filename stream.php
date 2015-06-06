<?php
	
	if(isset($_POST['stream_start'])) {
		echo shell_exec('$(cd rb-scripts/ ; sh stream-start.sh)');
		
	} else if(isset($_POST['stream_end'])) {
		echo shell_exec('$(cd rb-scripts/ ; sh stream-stop.sh)');
		
	} else if(isset($_POST['motion_start'])) {
		echo shell_exec('$(cd rb-scripts/ ; sh motion-start.sh)');
		
	} else if(isset($_POST['motion_end'])) {
		echo shell_exec('$(cd rb-scripts/ ; sh motion-end.sh)');
		
	} else if(isset($_POST['stream_add'])) {
		if(isset($_POST['ip']) && strlen($_POST['ip']) && isset($_POST['port']) && strlen($_POST['port'])) {
			include_once('bo/Stream.php');
			include_once('db/StreamDAO.php');
			
			$stream = new Stream($_POST['ip'], $_POST['port'], $_POST['name']);
			$dao = new StreamDAO();
			$dao->insertStream($stream);
		}
		
	} else if (isset($_POST['stream_delete'])) {
		if(isset($_POST['ip']) && strlen($_POST['ip']) && isset($_POST['port']) && strlen($_POST['port'])) {
			include_once('bo/Stream.php');
			include_once('db/StreamDAO.php');
			
			$stream = new Stream($_POST['ip'], $_POST['port'], $_POST['name']);
			$dao = new StreamDAO();
			$dao->deleteStream($stream);
		}
	}
?>