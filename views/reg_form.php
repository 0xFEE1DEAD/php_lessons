<!DOCTYPE html>

<html>
	<head>
		<title>Форма регистрации</title>
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
			if ($add_claim) {
				echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					Ваша заявка успешно принята!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>';
			}
		?>
		<form method="POST" class="card" style="width: 375px; margin: 100px auto; padding: 25px">
			<h5 class="card-title">Форма регистрации</h5>
			
  			<div class="input-group bottom_margin">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user"></i></span>
				</div>
				<input name="firstname" type="text"  placeholder="Имя" aria-label="Имя" value="<?= $firstname ?>" class="form-control <?= isempty($firstname) ? 'is-invalid' : ''?>">
				<input name="secondname" type="text" placeholder="Фамилия" aria-label="Фамилия" value="<?= $secondname ?>" class="form-control <?= isempty($secondname) ? 'is-invalid' : ''?>">
				<?= isempty($secondname) || isempty($firstname) ? '<div class="invalid-feedback">Введите своё имя и фамилию.</div>' : ''?>
			</div>

			<div class="input-group bottom_margin">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-envelope"></i></span>
				</div>
				<input name="mail" type="mail" class="form-control <?= isempty($mail) ? 'is-invalid' : ''?>" placeholder="е-mail" aria-label="е-mail" value="<?= $mail ?>">
				<?= isempty($mail) ? '<div class="invalid-feedback">Введите е-mail.</div>' : ''?>
			</div>
			
			<div class="input-group bottom_margin">
				<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-phone"></i></span>
				</div>
				<input name="phone_number" type="tel" class="form-control <?= isempty($phone_number) ? 'is-invalid' : ''?>
				" placeholder="Телефон" aria-label="Телефон" value="<?= $phone_number ?>">
				<?= isempty($phone_number) ? '<div class="invalid-feedback">Введите номер телефона.</div>' : ''?>
			</div>
			
			<div class="form-group bottom_margin">
				<label for="conference_theme_select">Интересующая тематика конференции</label>
				<select name="conference_theme" id="conference_theme_select" class="form-control">
					<?= render_options($conference_theme_array, 'conference_theme') ?>
				</select>
			</div>
			
			<div class="form-group bottom_margin">
				<label for="payment_method_select">Предпочитаемый метод оплаты участия</label>
				<select name="payment_method" id="payment_method_select" class="form-control">
					<?= render_options($payment_methods_array, 'payment_method') ?>
					
				</select>
			</div>
			
			<div class="form-check bottom_margin">
				<input name="mailing" class="form-check-input" id="mailing_checkbox" type="checkbox" value="true">
				<label class="form-check-label" for="mailing_checkbox" >Хочу получать рассылку о конференции</label>
			</div>
			
			<button type="submit" class="btn btn-primary">Отправить</button>
		</form>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>