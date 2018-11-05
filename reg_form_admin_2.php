<?php

define('DATABASE_FILE_NAME', 'database.db');
define('CLAIMS_DIR', './others/claims/');
define('SEPARATOR', '**');

if(isset($_POST['deleted_indexes'])) {
	delete_record($_POST['deleted_indexes']);
}

function delete_record($indexes) {
	$current_records_strs = get_records_strs();
  
  foreach ($indexes as $index) {
    if (substr_count($current_records_strs[$index], SEPARATOR) === 9) {
      $current_records_strs[$index] = $current_records_strs[$index] . SEPARATOR . 'deleted';
    }
	}
  
  $current_records_strs = join(PHP_EOL, $current_records_strs);
  file_put_contents(CLAIMS_DIR . DATABASE_FILE_NAME, $current_records_strs);
}

function get_records_strs() {
  if (is_file(CLAIMS_DIR . DATABASE_FILE_NAME)) {
  	return explode(PHP_EOL, file_get_contents(CLAIMS_DIR . DATABASE_FILE_NAME));
  }
  return '';
}

function parse_records_strs($records_str) {
  if ($records_str) {
    foreach($records_str as &$record) {
      $record = explode(SEPARATOR, $record); 
    }
  }
  return $records_str;
}

function render_tbody_from_files() {
	$value = '';

	$records = parse_records_strs(get_records_strs());
  
  if ($records) {
    foreach($records as $index=>$record) {
      if (count($record) === 10) {
        $value .= '<tr><td><input type="checkbox" name="deleted_indexes[]" value="' . $index . '"></td>';
        $value .= '<td>' . $record[0] . '</td>';
        $value .= '<td>' . $record[1] . '</td>';
        $value .= '<td>' . $record[2] . '</td>';
        $value .= '<td>' . $record[3] . '</td>';
        $value .= '<td>' . $record[4] . '</td>';
        $value .= '<td>' . $record[5] . '</td>';
        $value .= '<td>' . ($record[6] ? 'Согласен' : 'Нет') . '</td></tr>';
      }
    }
  }
	return $value;
}

include './views/reg_form_admin.php';