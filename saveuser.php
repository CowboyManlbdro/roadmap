<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Сохранение пользователя</title>
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
                if (($_GET['hash']) && ($_GET['mail']) ) {
                    $hash = $_GET['hash'];
                    $mail = $_GET['mail']; }
                if(isset($_POST['pass']) && $_POST['f'] && $_POST['i'] && $_POST['o'] && $_POST['tel'] && $_POST['org'] != ''){
                      $pass=$_POST['pass'];
                      $p=password_hash($pass, PASSWORD_DEFAULT);
                      $f=$_POST['f'];
                      $i=$_POST['i'];
                      $o=$_POST['o'];
                      $org=$_POST['org'];
                      $tel=$_POST['tel'];
                    //   var_dump($f);
                    //   var_dump($i);
                    //   var_dump($o);
                    //   var_dump($org);
                      UserUpdate($db, $mail, $p,$f,$i,$o,$org,$tel);
                      session_destroy();
                      ?>
                      <h2>Все сохранено!</h2> <br>
                      <button class="btn-primary" onclick="window.location.href='index.php'">На главную</button>
                      <?php
        } 
        else { session_destroy(); ?> 

            <h2>Заполните все поля!</h2> <br>
            <button class="btn-primary" onclick="window.location.href='regInvite.php?hash=<?php echo $hash ?>&mail=<?php echo $mail ?>'">Вернуться к заполнению</button>
            <?php }
            ?>          
        </center>
    </div>
    <div class="footer"><center></center></div>
</div>
</body>

</html>