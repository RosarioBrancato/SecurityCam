<?php
	class Video {
		
		private $id;
		private $date;
		private $time;
		private $filename;
		
		public function __construct($id, $date, $time, $filename) {
			$this->id = $id;
			$this->date = $date;
			$this->time = $time;
			$this->filename = $filename;
		}
		
		public function getDate() {
			return date('d.m.Y', strtotime($this->date));
		}
		
		public function getDateMySQL() {
			return $this->date;
		}
		
		public function getTime() {
			return date('H:i', strtotime($this->time));
		}
		
		public function getTimeMySQL() {
			return $this->time;
		}
		
		public function getFilename() {
			return $this->filename;
		}
		
	}