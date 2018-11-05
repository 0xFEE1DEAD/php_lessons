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
    <form action="/tasks/multiplication_table_functional.php" method="get">
      <input type="number" name="x"><br>
      <input type="number" name="y"><br>
    	<input type="submit" value="Отправить">
    </form>
		<?= get_multiplication_table((isset($_GET['x']) ? $_GET['x'] : 10), (isset($_GET['y']) ? $_GET['y'] : 10)) ?>
	</body>
</html>