<?php
	include_once('Connection.php');

	class VideoDAO {
		
		public function getVideos($filter) {
			$values = array();
			
			$connection = Connection::getConnection();
			
			$query = '';
			$query .= 'SELECT id, date, time, filename';
			$query .= ' FROM tbl_video';
			$query .= ' WHERE date BETWEEN ? AND ?';
			$query .= '	AND time BETWEEN ? AND ?';
			$query .= ' ORDER BY date DESC, time DESC';
			
			$stmt = $connection->prepare($query);
			if($stmt !== FALSE) {
				$stmt->bind_param('ssss', $filter->getDateMySQLFrom(), $filter->getDateMySQLTo(), $filter->getTimeMySQLFrom(), $filter->getTimeMySQLTo());
				$stmt->execute();
				
				$id;
				$date;
				$time;
				$filename;
				
				$stmt->bind_result($id, $date, $time, $filename);
				
				while($stmt->fetch()) {
					$values[$id] = new Video($id, $date, $time, $filename);
				}
				
				$stmt->close();
			}
			
			$connection->close();
			
			return $values;
		}
	}
?>