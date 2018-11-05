<?php

define('DATABASE_FILE_NAME', 'database.db');
define('CLAIMS_DIR', './others/claims/');
define('SEPARATOR', '**');

function get_value_from_array(&$array, $value) {
	return isset($array[$value]) ? $array[$value] : null;
}

function isempty ($value) {
	return ($value !== null) && ($value === '');
}

function compute_select(&$current_value, $post_key) {
	return (($current_value === get_value_from_array($_POST, $post_key)) ? ' selected ' : '');
}

function render_options($option_array, $request_variable_name) {
	$value = '';
	
	foreach ($option_array as $option) {
		$value .= '<option' . compute_select($option, $request_variable_name) . '>' . $option . '</option>';
	}
	
	return $value;
}


function save_claim() {
	$quantity_vars = count($_POST);
  
	if ($quantity_vars < 6 || $quantity_vars > 7) {
		return;
	}
  
	if (isempty(get_value_from_array($_POST, 'firstname')) || isempty(get_value_from_array($_POST, 'secondname')) || isempty(get_value_from_array($_POST, 'mail')) || isempty(get_value_from_array($_POST, 'phone_number'))) 
	{
		return;
	}
  
	$firstname = str_replace(SEPARATOR, '', $_POST['firstname']);
  $secondname = str_replace(SEPARATOR, '', $_POST['secondname']);
  $mail = str_replace(SEPARATOR, '', $_POST['mail']);
  $phone_number = str_replace(SEPARATOR, '', $_POST['phone_number']);
  
  $conference_theme = str_replace(SEPARATOR, '', get_value_from_array($_POST, 'conference_theme'));
  $payment_method = str_replace(SEPARATOR, '', get_value_from_array($_POST, 'payment_method'));
	$mailing = str_replace(SEPARATOR, '', get_value_from_array($_POST, 'mailing'));
  
  $record_str = implode([
    $firstname,
    $secondname,
    $mail,
    $phone_number,
    $conference_theme,
    $payment_method,
    $mailing, 
    getenv('REMOTE_ADDR'),
    date('l jS \of F Y h:i:s A'), 
    PHP_EOL,
	], SEPARATOR);
  
  
  file_put_contents(CLAIMS_DIR . DATABASE_FILE_NAME, $record_str, FILE_APPEND);
	
	global $add_claim, $firstname, $secondname, $mail, $phone_number, $conference_theme, $payment_method, $mailing;
  
	$add_claim = true;
	$firstname = null;
	$secondname = null;
	$mail = null;
	$phone_number = null;
	$conference_theme = null;
	$payment_method = null;
	$mailing = null;
}

$add_claim = false;
$firstname = get_value_from_array($_POST, 'firstname');
$secondname = get_value_from_array($_POST, 'secondname');
$mail = get_value_from_array($_POST, 'mail');
$phone_number = get_value_from_array($_POST, 'phone_number');
$conference_theme = get_value_from_array($_POST, 'conference_theme');
$payment_method = get_value_from_array($_POST, 'payment_method');
$mailing = get_value_from_array($_POST, 'mailing');

$conference_theme_array = [
	'Бизнес',
	'Технологии',
	'Реклама и Маркетинг',
];
	
$payment_methods_array = [
	'WebMoney',
	'Яндекс.Деньги',
	'PayPal',
	'Кредитная карта',
];

save_claim();

include "./views/reg_form.php";