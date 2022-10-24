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
                <?php 

                session_destroy();

                ?>
                <div id="dark">
                    <div id="darkwindow">
                        <h2>Вы успешно вышли из аккаунта!</h2> <br>
                        <a href="index.php" class="close">Закрыть окно</a>
                    </div>
                </div>
            </center>
        </div>
        <div class="footer"><center></center></div>
    </div>
</body>
</html>