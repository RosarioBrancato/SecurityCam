<?php
	class Filter {
		
		private $dateFrom;
		private $dateTo;
		private $timeFrom;
		private $timeTo;
		
		public function __construct() {
			$this->setDefaultValues();
		}
		
		public function setDefaultValues() {
			$this->dateTo = date('Y-m-d');
			$this->dateFrom = date('Y-m-d', strtotime('-7 day', strtotime($this->dateTo)));
			$this->timeFrom = '00:00:00';
			$this->timeTo = '23:59:59';
		}
		
		public function setValues($dateFrom, $dateTo, $timeFrom = '00:00:00', $timeTo = '23:59:59') {
			$this->dateFrom = $dateFrom;
			$this->dateTo = $dateTo;
			
			if(strlen($timeFrom) <= 5) {
				$timeFrom .= ':00';
			}
			$this->timeFrom = $timeFrom;
			
			if(strlen($timeTo) <= 5) {
				$timeTo .= ':59';
			}
			$this->timeTo = $timeTo;
		}
		
		public function getDateFrom() {
			return date('d.m.Y', strtotime($this->dateFrom));
		}
		
		public function getDateMySQLFrom() {
			return $this->dateFrom;
		}
		
		public function getDateTo() {
			return date('d.m.Y', strtotime($this->dateTo));
		}
		
		public function getDateMySQLTo() {
			return $this->dateTo;
		}
		
		public function getTimeFrom() {
			return date('H:i', strtotime($this->timeFrom));
		}
		
		public function getTimeMySQLFrom() {
			return $this->timeFrom;
		}
		
		public function getTimeTo() {
			return date('H:i', strtotime($this->timeTo));
		}
		
		public function getTimeMySQLTo() {
			return $this->timeTo;
		}
		
	}
?>