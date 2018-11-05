<?php
include './classes/reg_form_application.php';
include './others/reg_form_data/reg_form_data.php';

if (isset($_POST['deleted_files']) && is_array($_POST['deleted_files'])) {
	Application::deleteApplicationInFile(APPLICATION_FILEPATH, $_POST['deleted_files']);
	header('Location: ' . $_SERVER['REQUEST_URI']);
}

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

include './views/reg_form_admin.php';