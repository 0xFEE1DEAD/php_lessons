<!DOCTYPE html>

<html>
	<head>
		<title>Типа админка)</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>
	<body>
		<form method='POST'>
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">Имя</th>
				  <th scope="col">Фамилия</th>
				  <th scope="col">e-mail</th>
				  <th scope="col">Телефон</th>
				  <th scope="col">Выбранная тематика</th>
				  <th scope="col">Метод оплаты</th>
				  <th scope="col">Рассылка</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
					<?= render_tbody_from_files() ?>
				</tr>
			  </tbody>
			</table>
			<button type="submit" class="btn btn-primary">Удалить</button>
		</form>
	</body>
</html>