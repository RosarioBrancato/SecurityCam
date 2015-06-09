<?php
	
	if(isset($_POST['stream_start'])) {
		echo 'start stream... ';
		shell_exec("nohup raspivid -o - -t 0 -w 800 -h 600 -fps 30 |cvlc -v stream:///dev/stdin --sout '#standard{access=http,mux=ts,dst=:8554}' :demux=h264 > /dev/null 2>&1 &");
		echo ' done!';		

	} else if(isset($_POST['stream_end'])) {
		echo 'end stream...';
		$pid_stream = shell_exec("pidof raspivid");
		if(strlen($pid_stream) > 0) {
			shell_exec("pkill raspivid");
		}
		echo ' done!';
		
	} else if(isset($_POST['motion_start'])) {
		echo 'start motion...';
		shell_exec("nohup mmal/motion-mmal -n -c mmal/motion-mmalcam.conf 1>/dev/null 2>&1 </dev/null &");		
		echo ' done!';
		
	} else if(isset($_POST['motion_end'])) {
		echo 'end motion...';
		$pid_motion = shell_exec("pidof motion-mmal");
		if(strlen($pid_motion) > 0) {
			shell_exec("ps -ef | grep motion-mmal | awk '{print $2}' | xargs kill");
		}
		echo ' done!';
		
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