<?php

class Statistics {
	public function __construct($filepath) {
		$this -> filepath = $filepath;
		if (file_exists($filepath)) {
			$this -> statistics_data = json_decode(file_get_contents($filepath), true);
		} else {
			$this -> statistics_data = [
				'hits_counter' => 0,
				'sessions_counter' => 0,
				'ip_counter' => 0,
				'ips' => [],
			];
		}
	}
	
	public function __destruct() {
		file_put_contents($this -> filepath, json_encode($this -> statistics_data));
	}
	
	public function updateStatisticsHits() {
		++$this -> statistics_data['hits_counter'];
	}
	
	public function updateStatisticsIp() {
		if (isset($_SERVER['REMOTE_ADDR'])) {
			if (array_search($_SERVER['REMOTE_ADDR'], $this -> statistics_data['ips']) === false) {
				++$this -> statistics_data['ip_counter'];
				$this -> statistics_data['ips'][] = $_SERVER['REMOTE_ADDR'];
			}
		}
	}
	
	public function updateStatisticsSession() {
		if(!isset($_SESSION['statistics'])) {
			$_SESSION['statistics'] = true;
			++$this -> statistics_data['sessions_counter'];
		}
	}
	
	public function getHitsCount() {
		return $this -> statistics_data['hits_counter'];
	}
	
	public function getIpCount() {
		return $this -> statistics_data['ip_counter'];
	}
	
	public function getSessionCount() {
		return $this -> statistics_data['sessions_counter'];
	}

	private $filepath;
	private $statistics_data;
}