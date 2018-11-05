<!DOCTYPE html>

<html>
	<head>
		<title>Типа админка)</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
		<style>
			.chart-container {
			  position: relative;
			  margin: auto;
			  width: 90%;
			  height: 60vh;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand">Панель администратора</a>
			<form method="POST" class="form-inline">
				<button class="btn btn-outline-primary my-2 my-sm-0" name="session_break" type="submit">Выйти</button>
			</form>
		</nav>
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
		<div class="chart-container">
			<canvas id="myChart"></canvas>
		</div>
		<script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'pie',
				data: {
					labels: [
						"Загрузок страницы", "Посещений по IP", "Посещений по сессиям"
					],
					datasets: [
						{
							data: [<?= $statistics -> getHitsCount() ?>, <?= $statistics -> getIpCount() ?>, <?= $statistics -> getSessionCount() ?>],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
							],
							borderColor: [
								'rgba(255,99,132,1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
							],
							borderWidth: 1
						},
					]
				},
				options: {
                    maintainAspectRatio: false,
					title: {
						display: true,
						text: 'Статистика посещений'
					},
                }
			});
		</script>
	</body>
</html>