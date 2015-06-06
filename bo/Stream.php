<?php
	class Stream {
		
		private $ip;
		private $port;
		private $name;
		
		public function __construct($ip, $port, $name = '') {
			$this->ip = $ip;
			$this->port = $port;
			$this->name = $name;
		}
		
		public function getIp() {
			return $this->ip;
		}
		
		public function getPort() {
			return $this->port;
		}
		public function getName() {
			return $this->name;
		}
	}
?>