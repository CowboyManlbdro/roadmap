<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Активация</title>
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
    $mail = $_GET['mail'];
    if (HashMail ($db,$hash,$mail)){
        activateUser($db,$mail);
    
?>
          <div id="dark">
                        <div id="darkwindow">
                            <h2>Аккаунт успешно активирован!</h2> <br>
                            <a href="index.php" class="close">Закрыть окно</a>
                            </div>
                    </div>
    
           

            
<?php } else {
    ?> 
     <div id="dark">
                        <div id="darkwindow">
                            <h2>Что-то пошло не так!</h2> <br>
                            <a href="index.php" class="close">Закрыть окно</a>
                            </div>
                    </div>
    <?php
}
    

 } ?>
  </center>
        </div>
        <div class="footer"><center>Ползунок</center></div>
    </div>

</body>

</html>

