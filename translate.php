<?php
	function get_array_value(&$array, $value) {
		return (isset($array[$value]) ? $array[$value] : null);
	}
	function translate(&$string, $lang) {
		$dict = [
  			'en' => [
    				'hello' => 'Hello!',
    				'open' => 'Open',
    				'save' => 'Save',
    				'close_the_window' => 'Close the window?',
  			],
  			'ru' => [
    				'hello' => 'Привет!',
    				'open' => 'Открыть',
    				'save' => 'Сохранить',
    				'close_the_window' => 'Закрыть окно?',
  			],
		];
		$str_tmp = preg_replace('/\pP/iu', '', $string);
		$str_tmp = trim($str_tmp);
		$str_tmp = strtolower($str_tmp);
		$str_tmp = preg_split('/[\s,]+/', $str_tmp);
		
		foreach ($str_tmp as &$word) {
			if (isset($dict[$lang][$word])) {
				$word = $dict[$lang][$word];
			}
		}

		return join($str_tmp, ' ');
	}
	$input_field = get_array_value($_POST, 'input_field');

include "./views/translate.php";