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

class StatisticsDB {
	public function __construct() {
		$this -> dbo = new PDO('mysql:host=localhost;port=3306;dbname=mytest24;charset=utf8', 'mytest24', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}
	
	public function updateStatisticsHits() {
		$query_str = 'UPDATE `application_statistics` SET `hits_counter`=(`hits_counter`+1) WHERE 1;';
		$this -> dbo -> exec($query_str);
	}
	
	public function updateStatisticsIp() {
		$query_str = 'SELECT `ip` FROM `application_statistics_ips` WHERE `ip` = :ip;';
		$tbl = $this -> dbo -> prepare($query_str);
		$tbl -> execute(['ip' => $_SERVER['REMOTE_ADDR']]);
		$ip_has_been = $tbl -> fetchAll(PDO::FETCH_COLUMN);
		if (!$ip_has_been) {
			$query_str = 'INSERT INTO `application_statistics_ips`(`ip`) VALUES (:ip);';
			$tbl = $this -> dbo -> prepare($query_str);
			$tbl -> execute(['ip' => $_SERVER['REMOTE_ADDR']]);
			$query_str = 'UPDATE `application_statistics` SET `ip_counter`=(`ip_counter`+1) WHERE 1;';
			$this -> dbo -> exec($query_str);
		}
	}
	
	public function updateStatisticsSession() {
		if(!isset($_SESSION['statistics'])) {
			$_SESSION['statistics'] = true;
			$query_str = 'UPDATE `application_statistics` SET `sessions_counter`=(`sessions_counter`+1) WHERE 1;';
			$this -> dbo -> exec($query_str);
		}
	}
	
	public function getHitsCount() {
		$query_str = 'SELECT `hits_counter` FROM `application_statistics` WHERE 1';
		return $this -> dbo -> query($query_str) -> fetchAll(PDO::FETCH_COLUMN)[0];
	}
	
	public function getIpCount() {
		$query_str = 'SELECT `ip_counter` FROM `application_statistics` WHERE 1';
		return $this -> dbo -> query($query_str) -> fetchAll(PDO::FETCH_COLUMN)[0];
	}
	
	public function getSessionCount() {
		$query_str = 'SELECT `sessions_counter` FROM `application_statistics` WHERE 1';
		return $this -> dbo -> query($query_str) -> fetchAll(PDO::FETCH_COLUMN)[0];
	}
	
	private $dbo;
}