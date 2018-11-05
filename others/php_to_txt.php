<?php
ini_set('error_reporting', 0);
ini_set('display_errors', 0);

function open_and_show_file($path) {
	if (file_exists($path)) {
		echo '<h3>' . $path . '</h3>';
		echo highlight_string(file_get_contents($path), true);
	}
}

$first_filepath= '../' . $_GET['filename'];
$second_filepath = '../views/' . $_GET['filename'];

open_and_show_file($first_filepath);
open_and_show_file($second_filepath);