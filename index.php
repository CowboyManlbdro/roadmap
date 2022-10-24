<?php session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
	<?php include ('link.php') ?>

</head>
<body>

	
	<div class="header">
		<?php include ('header.php'); ?>
	</div>

	<div class="content">
		<div class="center">
			<center>
				<?php if(!empty($_SESSION)){ 
					if ($_SESSION['act']==1){
					include ('form.php'); }
					else {
					?>	<label>Проверьте почту и активируйте свой аккаунт!</label> <?php
					}
				}
				else {
					?>

					<label style="font-size: 30px;">Методичка для проектов</label>
					<p>
					<label style="font-size: 20px;">Данный ресурс поможет вам проверить готовность вашего проекта</label>
					<p>
					<label style="font-size: 20px;">Создайте проект, добавьте сотрудников </label>
					<p>
					<label style="font-size: 20px;">Ваша команда заполнит по ГОСТАМ файлы и загрузит их в проект</label>
					<p>
					<label style="font-size: 20px;">Вы или сотрудник данного ресурса оценит правильность заполнения файлов и подтвердит выполнение или же укажет на ошибки!</label>
					<p>
					<label style="font-size: 20px;">Чтобы начать авторизируйтесь или зарегистрируйтесь!</label>
					<p><button class="btn-primary" onclick="window.location.href='reg.php#darkreg'">Регистрация</button>

				<?php } ?>
			</center>

			

		</div>
	<div class="footer">
		<center>

		</center>	
	</div>
	</div>

</body>

</html>