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
		return preg_replace('/^(\\+7|8)\\s{0,1}(\\d{3})\\s{0,1}(\\d{3})\\-{0,1}(\\d{2})\\-{0,1}(\\d{2})$/u', '+7 ${2} ${3}-${4}-${5}', $this -> phone_number);
	}

	function getConferenceTheme() {
		return $this -> conference_theme;
	}

	function getPayMethod() {
		return $this -> pay_method;
	}

	function getMailing() {
		return $this -> mailing;
	}
  
	function checkFirstname() {
		if ($this -> firstname === "") {
			return 1; 
		}
		if (preg_match('/(^[А-Я][а-яё]+$)/u', $this -> firstname) === 0) {
			return 2;
		}
		$strlen = strlen($this -> firstname);
		if ($strlen > 255) {			
			return 4;
		}
		if ($strlen < 2) {
			var_dump(count($this -> firstname));
			return 5;
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
		$strlen = strlen($this -> firstname);
		if ($strlen > 255) {
			return 4;
		}
		if ($strlen < 2) {
			return 5;
		}

		return 0;
	}
  
	function checkEmail() {
		if ($this -> email === "") {
			return 1; 
		}
		if (preg_match('/(^[a-zA-Z\.\-_0-9]+@[a-zA-Z_]+?\.[a-zA-Z]{2,6}$)/u', $this -> email) === 0) {
			return 2;
			
		}
		$strlen = strlen($this -> firstname);
		if ($strlen > 255) {
			return 4;
		}
		if ($strlen < 2) {
			return 5;
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

class ApplicationsDatabase {
	public function __construct() {
		$this -> dbo = new PDO('mysql:host=localhost;port=3306;dbname=mytest24;charset=utf8', 'mytest24', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}
	
	public function getApplications() {
		$query_str = 'SELECT
					`applications_applications`.`id`,
					`firstname`, 
					`secondname`, 
					`email`, 
					`phone_number`, 
					`mailing`,
					`created_at`,
					`applications_conference_themes`.`name` as `conference_theme`,
					`applications_pay_methods`.`name` as `payment_method`
					FROM `applications_applications`
					LEFT JOIN `applications_conference_themes` ON `applications_applications`.`conference_theme_id` = `applications_conference_themes`.`id`
					LEFT JOIN `applications_pay_methods` ON `applications_applications`.`payment_method_id` = `applications_pay_methods`.`id`;';
		$tmp_arr = $this -> dbo -> query($query_str);

		return $tmp_arr;
	}
	
	public function addApplication(&$application) 
	{
		$query_str = 'SELECT `id` FROM `applications_conference_themes` WHERE name = :conference_theme';
		$tbl = $this -> dbo -> prepare($query_str);
		$tbl -> execute(['conference_theme' => $application -> getConferenceTheme()]);
		$conference_theme_id = $tbl -> fetchAll(PDO::FETCH_COLUMN)[0];
		
		$query_str = 'SELECT `id` FROM `applications_pay_methods` WHERE name = :pay_method';
		$tbl = $this -> dbo -> prepare($query_str);
		$tbl -> execute(['pay_method' => $application -> getPayMethod()]);
		$payment_method_id =  $tbl -> fetchAll(PDO::FETCH_COLUMN)[0];

		$query_str = 'INSERT INTO `applications_applications`
		(`firstname`,
		`secondname`,
		`email`,
		`phone_number`,
		`conference_theme_id`, 
		`payment_method_id`, 
		`mailing`, 
		`created_at`) 
		 VALUES 
		(:firstname,
		 :secondname,
		 :email,
		 :phone_number,
		 :conference_theme_id,
		 :payment_method_id,
		 :mailing,
		 :time_)';
		 
		$tbl = $this -> dbo -> prepare($query_str);
		$param_array = [  
						'firstname' => $application -> getFirstname(),
						'secondname' => $application -> getSecondname(),
						'email' => $application -> getEmail(),
						'phone_number' => $application -> getPhoneNumber(),
						'conference_theme_id' => (int)$conference_theme_id,
						'payment_method_id' => (int)$payment_method_id,
						'mailing' => $application -> getMailing(),
						'time_' => time(),
						];

		$tbl -> execute($param_array);
	}
	
	public function getConferenceThemes() {
		return $this -> dbo -> query('SELECT `name` FROM `applications_conference_themes`') -> fetchAll(PDO::FETCH_COLUMN);
	}
	
	public function getPaymentMethods() {
		return $this -> dbo -> query('SELECT `name` FROM `applications_pay_methods`') -> fetchAll(PDO::FETCH_COLUMN);
	}
	
	public function deleteApplications($applications_ids) {
		$in_query = implode(',', array_fill(0, count($applications_ids), '?'));
		$query_str = 'DELETE FROM `applications_applications` WHERE `id` IN (' . $in_query . ')';
		$tbl = $this -> dbo -> prepare($query_str);
		
		$tbl -> execute($applications_ids);
	}

	private $dbo;
}