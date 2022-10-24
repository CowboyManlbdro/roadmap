<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
	 <?php include ('link.php') ?>

</head>
<body>
	<div class="header">
		<?php include ('header.php'); ?>
	</div>

	<div class="content">
		<div class="center">
			<center>
				<div id="darkreg">
                    <div id="darkwindowreg">
				<h1>РЕГИСТРАЦИЯ</h1>
				<table style="border-spacing: 7px 11px;">
					<form method="post" action="newuser.php#dark">
					<tr>
						<td>Почта</td>
						<td>Пароль</td>
					</tr>
					<tr>
						<td><input type="email" name="mail"></td>
						<td><input type="password" id="password-input" name="pass"></td>
						<td><a href="#" class="password-control" onclick="return show_hide_password(this);"></a></td>
					</tr>
					<tr>
						<td>Фамилия</td>
						<td>Организация</td>
					</tr>
					<tr>
						<td><input type="text" name="f" size="50"></td>
						<td><input type="text" name="org" size="50"></td>
					</tr>
					<tr>
						<td>Имя</td>
						<td>Телефон</td>
					</tr>
					<tr>
						<td><input type="text" name="i"></td>
						<td><input id="online_phone" type="tel" value="+7(___)___-__-__" name="tel" pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" placeholder="+7(___)___-__-__"></td>
					</tr>
					<tr>
						<td>Отчество</td>
						<td><img src='captcha.php' id='captcha-image'>  </td>              
					</tr>
					<tr>
						<td><input type="text" name="o"></td>
						 
                                <td><input type="text" name="captcha" placeholder="Введите код с картинки " required />
                                </td>
					</tr>
					<tr>
						<td colspan="3"><button class="btn-primaryreg">Зарегистрироваться</button></td>
					</tr>
					</form>
				</table>
				<button class="btn-primaryreg" onclick="window.location.href='sd.php'">Закрыть окно</button>
			</div>
		</div>
			</center>
		</div>
		<div class="footer"><center></center></div>
	</div>
</body>




</html>