<?php
	include_once('Connection.php');

	class StreamDAO {
		
		public function getStreams() {
			$values = array();
			
			$connection = Connection::getConnection();
			
			$query = '';
			$query .= 'SELECT ip, port, name';
			$query .= ' FROM tbl_stream';
			$query .= ' ORDER BY name, ip, port';
			
			$stmt = $connection->prepare($query);
			if($stmt !== FALSE) {
				$stmt->execute();
				
				$ip;
				$port;
				$name;
				
				$stmt->bind_result($ip, $port, $name);
				
				while($stmt->fetch()) {
					$values[$ip . ':' . $port] = new Stream($ip, $port, $name);
				}
				
				$stmt->close();
			}
			
			$connection->close();
			
			return $values;
		}
		
		public function insertStream($stream) {
			$connection = Connection::getConnection();
			
			$query = 'INSERT INTO tbl_stream VALUES (?, ?, ?)';
			
			$stmt = $connection->prepare($query);
			if($stmt !== FALSE) {
				$stmt->bind_param('sss', $stream->getIp(), $stream->getPort(), $stream->getName());
				$stmt->execute();
				$stmt->close();
			}
			
			$connection->close();
		}
		
		public function deleteStream($stream) {
			$connection = Connection::getConnection();
			
			$query = 'DELETE FROM tbl_stream WHERE ip = ? AND port = ?';
			
			$stmt = $connection->prepare($query);
			if($stmt !== FALSE) {
				$stmt->bind_param('ss', $stream->getIp(), $stream->getPort());
				$stmt->execute();
				$stmt->close();
			}
			
			$connection->close();
		}
	}
?>