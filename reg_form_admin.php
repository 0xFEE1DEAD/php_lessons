<?php

define ('CLAIMS_DIR', './others/claims/');

function check_file_name(&$file_name) {
  $matches = null;
  preg_match('/\d+\.json/', $file_name, $matches, PREG_OFFSET_CAPTURE);

  return count($matches) === 1 && $matches[0][1] === 0 && is_file(CLAIMS_DIR . $file_name);
}

if(isset($_POST['deleted_files'])) {
	foreach ($_POST['deleted_files'] as $file_name) {
		if (check_file_name($file_name)) {
			unlink(CLAIMS_DIR . $file_name);
		}
	}
}

function render_tbody_from_files() {
	$value = '';

	$file_names = scandir(CLAIMS_DIR, SCANDIR_SORT_NONE);
	foreach($file_names as $file_name) {
		if ($file_name === '.' || $file_name === '..' || stripos($file_name, '.json') === false) {
			continue;
		}
		$json_tmp = json_decode(file_get_contents(CLAIMS_DIR . $file_name), true);
		$value .= '<tr><td><input type="checkbox" name="deleted_files[]" value="' . $file_name . '"></td>';
		$value .= '<td>' . $json_tmp['firstname'] . '</td>';
		$value .= '<td>' . $json_tmp['secondname'] . '</td>';
		$value .= '<td>' . $json_tmp['mail'] . '</td>';
		$value .= '<td>' . $json_tmp['phone_number'] . '</td>';
		$value .= '<td>' . $json_tmp['conference_theme'] . '</td>';
		$value .= '<td>' . $json_tmp['payment_method'] . '</td>';
		$value .= '<td>' . (isset($json_tmp['mailing']) ? 'Согласен' : 'Нет') . '</td></tr>';
	}
	return $value;
}

include './views/reg_form_admin.php';