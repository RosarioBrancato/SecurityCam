<?php
	class Connection {
		function getConnection() {
			$mysqli = new mysqli('localhost', 'root', '', 'security_cam');
			$mysqli->set_charset('utf8');
			
			return $mysqli;
		}
	}
?>