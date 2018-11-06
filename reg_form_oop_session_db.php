<?php
	session_start();

	$empty_request = true;
	if (!empty($_POST)) {
		if (
			isset($_POST['firstname']) &&
			isset($_POST['secondname']) &&
			isset($_POST['email']) &&
			isset($_POST['phone_number']) &&
			isset($_POST['conference_theme']) &&
			isset($_POST['payment_method'])
		)
		{
			if(isset($_POST['mailing'])) {
				$_POST['mailing'] = true;
			} else {
				$_POST['mailing'] = false;
			}
			$empty_request = false;
		}
		else
		{
			echo "400 Bad Request";
		}
	}

	include './classes/reg_form_application.php';
	include './others/reg_form_data/reg_form_messages.php';
	include './others/reg_form_data/reg_form_data.php';
	include 'classes/reg_form_statistics.php';

	$statistics = new StatisticsDB();
	$statistics -> updateStatisticsHits();
	$statistics -> updateStatisticsIp();
	$statistics -> updateStatisticsSession();

	$return_error_messages = [];
	$application_saved = false;
	$application = null;
	$application_db = new ApplicationsDatabase();
	$conference_themes = $application_db -> getConferenceThemes();
	$pay_methods = $application_db -> getPaymentMethods();

	if(!$empty_request) {
		$check_result = 0;
		$application = new Application(
								$_POST['firstname'],
								$_POST['secondname'],
								$_POST['email'],
								$_POST['phone_number'],
								$_POST['conference_theme'],
								$_POST['payment_method'],
								$_POST['mailing']
							);
							
		foreach (array_keys($_POST) as $field_name) {
			$check_result = $application -> checkFieldByName($field_name, $conference_themes, $pay_methods);
			if ($check_result == 3) {
				echo "400 Bad Request";
				exit;
			}
			if($check_result) {
				$return_error_messages[$field_name] = $error_field_messages[$check_result];
			}
		}
		
		if (empty($return_error_messages)) {
			$application_db -> addApplication($application);
			$application_saved = true;
			$application = new Application();
		}
	} else {
		$application = new Application();
	}
	
	function render_conference_options() {
		global $conference_themes;
		global $application;
		$value = '';
		
		foreach ($conference_themes as $option) {
			$value .= '<option' . (($application->getConferenceTheme() === $option) ? ' selected ' : '') . '>' . $option . '</option>';
		}
		
		return $value;
	}
	
	function render_payment_method_options() {
		global $pay_methods;
		global $application;
		$value = '';
		
		foreach ($pay_methods as $option) {
			$value .= '<option' . (($application->getPayMethod() === $option) ? ' selected ' : '') . '>' . $option . '</option>';
		}
		
		return $value;
	}

include 'views/reg_form_oop.php';