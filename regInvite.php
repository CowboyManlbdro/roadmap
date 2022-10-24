<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <title>Регистрация</title>
    <?php include('link.php') ?>

</head>

<body>


    <div class="header">
        <?php include('header.php'); ?>
    </div>

    <div class="content">
        <div class="center">
            <center>
            <?php 
            if (($_GET['hash']) && ($_GET['mail']) ) {
                $hash = $_GET['hash'];
                $mail = $_GET['mail'];
                if (HashMail ($db,$hash,$mail)){
                    activateUser($db,$mail);
                }?>
                        <div id="darkreg">
                    <div id="darkwindowreg">
				<h1>РЕГИСТРАЦИЯ</h1>
				<table style="border-spacing: 7px 11px;">
					<form method="post" action="saveuser.php?hash=<?php echo $hash ?>&mail=<?php echo $mail ?>">
					<tr>
						<td>Почта</td>
						<td>Пароль</td>
					</tr>
					<tr>
						<td><input type="email" disabled name="mail" value="<?php echo $mail ?>"></td>
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
					</tr>
					<tr>
						<td><input type="text" name="o"></td>
					</tr>
					<tr>
						<td colspan="3"><button class="btn-primaryreg">Сохранить</button></td>
					</tr>
					</form>
				</table>
			</div>
		</div>
               <?php }
            ?>
            </center>

        </div>
        <div class="footer">

        </div>
    </div>

</body>

</html>