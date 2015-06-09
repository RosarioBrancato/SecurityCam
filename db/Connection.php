<?php
	class Connection {
		function getConnection() {
			$mysqli = new mysqli('localhost', 'root', '1234', 'security_cam');
			$mysqli->set_charset('utf8');
			
			return $mysqli;
		}
	}
?>