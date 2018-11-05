<!DOCTYPE html>

<html>
	<head>
		<title></title>
		<style>
			.translate_field {
				border: lightblue 2px solid;
				width: 300px;
				height: 150px;
				display: inline-block;
				float: left;
				margin: 10px;
				padding: 5px;
			}
			.translate_button {
				background-color: lightblue;
				border: 0px;
				padding: 5px;
				margin: 10px;
			}
		</style>
	</head>
	<body>
		<form method="POST">
			<textarea class="translate_field" name="input_field"><?= $input_field ?></textarea>
			<span class="translate_field"><?= translate($input_field, 'ru'); ?></span>
			<button class="translate_button" type="submit">Перевести</button>
		</form>
	</body>
</html>
