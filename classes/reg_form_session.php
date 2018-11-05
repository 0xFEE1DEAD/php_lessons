<?php
class Session {
	public function __construct() {
		$this -> last_action_time = time();
	}
	
	public function updateSessionTime() {
		if (($this -> last_action_time) > 0) {
			$this -> last_action_time = time();
		}
	}
	public function sessionIsValid() {
		return ($this -> last_action_time > 0) && ($this -> last_action_time + 300) > time();
	}

	public function breakSession() {
		$this -> last_action_time = -1;
	}
	
	public function breackedByTime() {
		return $this -> sessionIsValid();
	}
	
	private $last_action_time;
}