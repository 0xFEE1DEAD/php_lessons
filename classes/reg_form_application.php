<?php

class Application {  
	function __construct(
		$firstname = '',
		$secondname = '',
		$email = '',
		$phone_number = '',
		$conference_theme = '',
		$pay_method = '',
		$mailing = ''
	)
	{
		$this -> firstname = $firstname;
		$this -> secondname = $secondname;
		$this -> email = $email;
		$this -> phone_number = $phone_number;
		$this -> conference_theme = $conference_theme;
		$this -> pay_method = $pay_method;
		$this -> mailing = $mailing;
	}

	function setFirstname($value) {
		$this -> firstname = $value;
	}

	function setSecondname($value) {
		$this -> secondname = $value;
	}

	function setEmail($value) {
		$this -> email = $value;
	}

	function setPhoneNumber($value) {
		$this -> phone_number = $value;
	}

	function setConferenceTheme($value) {
		$this -> conference_theme = $value;
	}

	function setPayMethod($value) {
		$this -> pay_method = $value;
	}

	function setMailing($value) {
		$this -> mailing = $value;
	}

	function getFirstname() {
		return $this -> firstname;
	}

	function getSecondname() {
		return $this -> secondname;
	}

	function getEmail() {
		return $this -> email;
	}

	function getPhoneNumber() {
		return $this -> phone_number;
	}

	function getConferenceTheme() {
		return $this -> conference_theme;
	}

	function getPayMethod() {
		return $this -> pay_method;
	}

	function gettMailing() {
		return $this -> mailing;
	}
  
	function checkFirstname() {
		if ($this -> firstname === "") {
			return 1; 
		}
		if (preg_match('/^[А-Я][а-яё]+$/u', $this -> firstname) === 0) {
			return 2;
		}
		
		return 0;
	}
  
	function checkSecondname() {
		if ($this -> secondname === "") {
			return 1; 
		}
		if (preg_match('/(^[А-Я][а-яё]+$)|(^[А-Я][а-я]+\-[А-Я][а-яё]+$)/u', $this -> secondname) === 0) {
			return 2;
		}

		return 0;
	}
  
	function checkEmail() {
		if ($this -> secondname === "") {
			return 1; 
		}
		if (preg_match('/^[a-zA-Z\.\-_0-9]+@[a-zA-Z_]+?\.[a-zA-Z]{2,6}$/u', $this -> email) === 0) {
			return 2;
			
		}

		return 0;
	}

	function checkPhoneNumber() {
		if ($this -> phone_number === "") {
			return 1; 
		}
		if (preg_match('/^(\+7|8)\s{0,1}\d{3}\s{0,1}\d{3}\-{0,1}\d{2}\-{0,1}\d{2}$/u', $this -> phone_number) === 0) {
			return 2;
		}

		return 0;
	}

	function checkConferenceTheme(&$conference_themes) {
		if ((bool)in_array($this -> conference_theme, $conference_themes)) {
			return 0;
		}
		return 3;
	}

	function checkPayMethod(&$pay_methods) {
		if ((bool)in_array($this -> pay_method, $pay_methods)) {
			return 0;
		}
		return 3;
	}

	function checktMailing() {
		if (is_bool($this -> mailing)) {
			return 0;
		}
		return 3;
	}
	
	function checkFieldByName($fileld_name, &$conference_themes, &$pay_methods) {
		switch ($fileld_name) {
			case 'firstname': {
				return $this -> checkFirstname();
			}
			case 'secondname': {
				return $this -> checkSecondname();
			}
			case 'email': {
				return $this -> checkEmail();
			}
			case 'phone_number': {
				return $this -> checkPhoneNumber();
			}
			case 'conference_theme': {
				return $this -> checkConferenceTheme($conference_themes);
			}
			case 'payment_method': {
				return $this -> checkPayMethod($pay_methods);
			}
			case 'mailing': {
				return $this -> checktMailing();
			}
		}
	}
	
	function writeToFile($filepath) {
		$this -> phone_number = preg_replace('/^(\\+7|8)\\s{0,1}(\\d{3})\\s{0,1}(\\d{3})\\-{0,1}(\\d{2})\\-{0,1}(\\d{2})$/u', '+7 ${2} ${3}-${4}-${5}', $this -> phone_number);
		$arr = [
				'firstname' => $this -> firstname,
				'secondname' => $this -> secondname,
				'email' => $this -> email,
				'phone_number' => $this -> phone_number,
				'conference_theme' => $this -> conference_theme,
				'pay_method' => $this -> pay_method,
				'mailing' => $this -> mailing,
		];
		if (file_exists($filepath)) {
			$json_from_file = json_decode(file_get_contents($filepath), true);
			$json_from_file[] = $arr;
			file_put_contents($filepath, json_encode($json_from_file));
		} else {
			file_put_contents($filepath, json_encode([$arr]));
		}
	}
	
	static function readFromFile($filepath) {
		return json_decode(file_get_contents($filepath), true);
	}
	
	static function deleteApplicationInFile($filepath, $index) {
		$arr = json_decode(file_get_contents($filepath), true);
		if(is_array($index)) {
			foreach ($index as $i) {
				unset($arr[$i]);
			}
		} else {
			unset($arr[$index]);
		}
		file_put_contents($filepath, json_encode($arr));
	}
  
	private $firstname;
	private $secondname;
	private $email;
	private $phone_number;
	private $conference_theme;
	private $pay_method;
	private $mailing;
  
}