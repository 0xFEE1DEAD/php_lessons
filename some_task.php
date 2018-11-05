<?php

$arr = [1, '', 3, '', 5, 6, '', false, null, 0];

function deleteEmptyStr(&$array) {
  $result = [];
  foreach($array as &$elem) {
    if ($elem !== '') {
			$result[] = $elem;
    }
  }
  return $result;
}

var_dump(deleteEmptyStr($arr));

switch (isset($_GET['a']) ? $_GET['a'] : -1) {
  case 'мир':
  case 'люди': {
  	echo 'Это мир или люди';
    break;
  }
  case 'понедельник':
  case 'вторник':
  case 'среда':
  case 'четверг':
  case 'пятница':
  case 'суббота':
  case 'воскресение': {
  	echo 'Это день недели';
    break;
  }
  default: {
  	echo 'Не знаю что это!';
    break;
  }
}

$arr_ = [
  1 => 'Значение 3',
	'01' => 'значение 6',
];

var_dump($arr_);