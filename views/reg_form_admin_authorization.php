<!DOCYPE html>

<html>
	<head>
		<title>Авторизация</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<style>
			.bottom_margin {
				margin-bottom: 10px;
			}
		</style>
	</head>
	<body>
		<?php
			if ($session_breaked) {
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Сессия была разорвана из-за бездействия в течении 5 минут!.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>';
			}
		?>
		<form method="POST" class="card" style="width: 375px; margin: 100px auto; padding: 25px">
			<h5 class="card-title">Авторизация</h5>
			<div class="input-group bottom_margin" style="margin-bottom: 10px">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
				<input name="login" type="text" class="form-control <?= $error_login ? 'is-invalid' : ''?>" placeholder="Введите логин" aria-label="Логин" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>">
				<?= $error_login ? '<div class="invalid-feedback">Неверный логин.</div>' : ''?>
			</div>
			
			<div class="input-group bottom_margin">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
				</div>
				<input name="password" type="password" class="form-control <?= $error_password ? 'is-invalid' : ''?>" placeholder="Введите пароль" aria-label="Пароль" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
				<?= $error_password ? '<div class="invalid-feedback">Неверный пароль.</div>' : ''?>
			</div>
			<button type="submit" class="btn btn-primary">Войти <i class="fas fa-sign-in-alt"></i></button>
		</form>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>