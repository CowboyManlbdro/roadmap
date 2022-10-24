<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <?php include ('link.php') ?>

</head>
<body>
    <div class="header">
        <?php include ('header.php'); ?>
    </div>

    <div class="content">
        <div class="center">
            <center>
                <?php 
                if(!empty($_POST)){
                    if ($_POST['log']!='' && $_POST['pass']!= ''){
                        $login=trim(strip_tags($_POST['log']));
                        $password=trim(strip_tags($_POST['pass']));
                        $user = getUser($db, $login);
                        if (password_verify($password, $user['password'])) {
                            $_SESSION ['role']=$user['role'];
                            $_SESSION ['f']=$user['f'];
                            $_SESSION ['i']=$user['i'];
                            $_SESSION ['o']=$user['o'];
                            $_SESSION ['act']=$user['activation'];
                            $_SESSION ['mail']=$user['mail'];
                            ?>             
                    <div id="dark">
                        <div id="darkwindow">
                            <h2>Вы успешно вошли!</h2> <br>
                            <a href="index.php" class="close">Закрыть окно</a>
                        </div>
                    </div>

                            <?php
                        }

                        else {
                            ?>
                            <div id="dark">
                        <div id="darkwindow">
                            <h2>Не правильно введен логин или пароль!</h2> <br>
                            <a href="index.php" class="close">Закрыть окно</a>
                            </div>
                    </div>
                            <?php
                        }

                    }
                    else {
                        ?>
                        <div id="dark">
                        <div id="darkwindow">
                        <h2>Заполните все поля!</h2> <br>
                        <a href="index.php" class="close">Закрыть окно</a>
                        </div>
                    </div>
                        <?php
                    }
                } 

                ?>
            </center>
        </div>
        <div class="footer"><center></center></div>
    </div>
</body>
</html>