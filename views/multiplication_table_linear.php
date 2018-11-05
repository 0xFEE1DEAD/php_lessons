<!DOCTYPE html>

<html>
	<head>
		<title>Таблица умножения</title>
		<style>
			.multiplication_table {
				background-color: red;
			}
			.multiplication_cell {
				width: 50px;
				height: 50px;
				text-align: center;
			}
			.multiplication_header_cell {
				background-color: orange;
			}

			.multiplication_simple_cell {
				background-color: white;
			}

			.multiplication_intersection_cell {
				background-color: yellow;
			}
		</style>
	</head>

	<body>
		<?= get_multiplication_table() ?>
	</body>
</html>