<?php
	function get_multiplication_table() {
		$value = '<table class="multiplication_table"><tbody><tr>';

		for($i = 0; $i <= 10; ++$i) {
			$value = $value . '<td class="multiplication_cell multiplication_header_cell">';
			$value = $value . ($i ? $i : ' ');
			$value = $value . '</td>';

		}

		$value = $value . '</tr>';

		for($i = 1; $i <= 10; ++$i) {
			$value = $value . '<tr>';
			for($j = 1; $j <= 10; ++$j) {
				if ($j === 1) {
					$value = $value . '<td class="multiplication_cell multiplication_header_cell">';
					$value = $value . $i;
					$value = $value . '</td>';
				}

				if ($i !== $j) {
					$value = $value . '<td class="multiplication_cell multiplication_simple_cell">';
				} else {
					$value = $value . '<td class="multiplication_cell multiplication_intersection_cell">';
				}
				$value = $value . ($i * $j);
				$value = $value . '</td>';
			}
			$value = $value . '</tr>';
		}
		$value = $value . '</tbody></table>';
		return $value;
	}

	include './views/multiplication_table_linear.php';