<?php
include './classes/reg_form_application.php';
include './classes/reg_form_session.php';
include './others/reg_form_data/reg_form_data.php';
include 'classes/reg_form_statistics.php';

session_start();

if (isset($_SESSION['session']) && $_SESSION['session'] -> sessionIsValid()) {
	$_SESSION['session'] -> updateSessionTime();
	
	if (isset($_POST['session_break'])) {
		$_SESSION['session'] -> breakSession();
		header('Location: ' . $_SERVER['REQUEST_URI']);
	}
	
	if (isset($_POST['deleted_files']) && is_array($_POST['deleted_files'])) {
		Application::deleteApplicationInFile(APPLICATION_FILEPATH, $_POST['deleted_files']);
		header('Location: ' . $_SERVER['REQUEST_URI']);
	}

	$statistics = new Statistics(STATISTICS_FILEPATH);
	
	$applications = Application::readFromFile(APPLICATION_FILEPATH);

	function render_tbody_from_files() {
		global $applications;
		$value = '';
		foreach ($applications as $index => $application) {
			$value .= '<tr>';
			$value .= '<td><input type="checkbox" name="deleted_files[]" value="' . $index . '"></td>';
			$value .= '<td>' . $application['firstname'] . '</td>';
			$value .= '<td>' . $application['secondname'] . '</td>';
			$value .= '<td>' . $application['email'] . '</td>';
			$value .= '<td>' . $application['phone_number'] . '</td>';
			$value .= '<td>' . $application['conference_theme'] . '</td>';
			$value .= '<td>' . $application['pay_method'] . '</td>';
			$value .= '<td>' . ($application['mailing'] ? 'Согласен' : 'Нет') . '</td>';
			$value .= '</tr>';
		}
		return $value;
	}

	include './views/reg_form_oop_admin_session.php';
} else {
	$error_password = false;
	$error_login = false;
	$session_breaked = isset($_SESSION['session']) && $_SESSION['session'] -> breackedByTime();

	if (isset($_POST['password']) && isset($_POST['login'])) {
		if ($_POST['login'] !== 'admin') {
			$error_login = true;
		}
		
		$salt = 'f3d07de5efb5e2c3eafc16b0cf7e07fa';
		if (sha1(($_POST['password'] . $salt)) === '05054214685b49d6204fbb38d5f17409e64e43a4') {
			if (!$error_login) {
				$_SESSION['session'] = new Session();
				header('Location: ' . $_SERVER['REQUEST_URI']);
			}
		} else {
			$error_password = true;
		}
	}
	
	include './views/reg_form_admin_authorization.php';
}