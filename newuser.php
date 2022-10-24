<?php session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Новый пользователь</title>
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
                if (isset($_POST['mail']) && $_POST['pass'] && $_POST['f'] && $_POST['i'] && $_POST['o'] && $_POST['tel'] && $_POST['org'] != '') {
                    $captcha = trim($_POST["captcha"]);

                    if ($_SESSION["rand_captcha"] != $captcha) {
                        session_destroy();
                ?>
                        <div id="dark">
                            <div id="darkwindow">
                                <h2>Неправильно введена картинка!</h2> <br>
                                <a href="reg.php" class="close">Закрыть окно</a>
                            </div>
                        </div>

                        <?php

                    } else {
                        $l = $_POST['mail'];
                        if (LoginFree($db, $l)) {
                            $pass = $_POST['pass'];
                            $p = password_hash($pass, PASSWORD_DEFAULT);
                            $hash = md5($l . time());
                            $f = $_POST['f'];
                            $i = $_POST['i'];
                            $o = $_POST['o'];
                            $org = $_POST['org'];
                            $tel = $_POST['tel'];
                            $role = "user";
                            $activation = 0;

                            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                            try {
                                //Server settings
                                $mail->setLanguage('ru', 'vendor/phpmailer/phpmailer/language/'); // Перевод на русский язык
                                $mail->CharSet = "utf-8";

                                //Enable SMTP debugging
                                // 0 = off (for production use)
                                // 1 = client messages
                                // 2 = client and server messages
                                $mail->SMTPDebug = 0;                                 // Enable verbose debug output

                                $mail->isSMTP();                                      // Set mailer to use SMTP

                                $mail->SMTPAuth = true;                               // Enable SMTP authentication

                                //$mail->SMTPSecure = 'ssl';                          // secure transfer enabled REQUIRED for Gmail
                                //$mail->Port = 465;                                  // TCP port to connect to
                                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 587;                                    // TCP port to connect to

                                $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                                $mail->Username = 'roadmap@tsput.ru';               // SMTP username

                                //Recipients
                                $mail->setFrom('roadmap@tsput.ru', 'roadmap');
                                $mail->addAddress($l);              // Name is optional

                                //Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Подтвердите Email на сайте';
                                $mail->Body    = '<html lang="ru">
                        <head>
                            <meta charset="UTF-8">
                            <title>Document</title>
                        </head>
                        <body style="margin: 0; padding: 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tr>
                            <td align="center" style="padding: 40px 0 30px 0;">
                                <img src="http://roadmap.tsput.ru/img/logotspu.png" alt="Логотип ТГПУ" width="100" height="122" style="display: block;" />
                                <br>
                                <h1 style="font-family: Arial, Helvetica, sans-serif ; color: #1480c0;">ДОРОЖНАЯ КАРТА</h1>
                               </td>
                        </tr>
                        <tr>
                         <td align="center" bgcolor="#ffffff">
                          <h3 style="font-family:"Arial, Helvetica, sans-serif; color: #1480c0;">Спасибо за регистрацию! <br>Чтобы активировать свой аккаунт, нажмите на кнопку ниже!</h3>
                         </td>
                        </tr>
                        <tr>
                         <td align="center">
                         <div><!--[if mso]>
                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:53px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#1480c0">
                                <w:anchorlock/>
                                <center>
                                            <![endif]-->
                                 <a href="http://roadmap.tsput.ru//activate.php?hash=' . $hash . '&mail=' . $l . '#dark"
                                style="background-color:#1480c0;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:53px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">АКТИВИРОВАТЬ</a>
                            <!--[if mso]>
    </center>
  </v:roundrect>
<![endif]--></div>
<br>
                         </td>
                        </tr>
                       </table>
                       </body>
                        </html>';
                                $mail->AltBody = '<p>Что бы подтвердить Email, перейдите по <a href="http://roadmap.tsput.ru//activate.php?hash=' . $hash . '&mail=' . $l . '#dark">ссылке</a></p>';
                                // style="display: inline-block;font-weight: 400;line-height: 1.5;color: #1480c0;text-align: center;text-decoration: none;vertical-align: middle;cursor: pointer;background-color: white;border: 1px solid #1480c0;padding: 0.375rem 0.75rem;font-size: 1rem;border-radius: 0.25rem;transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;box-shadow: 0 0.1875rem 0.1875rem 0 rgba(0, 0, 0, 0.1) !important;padding: 1.25rem 2rem;font-family: "Varela Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";font-size: 80%;text-transform: uppercase;letter-spacing: 0.15rem;"
                                $mail->send();
                                // echo 'Message has been sent';
                                addUser($db, $l, $p, $hash, $f, $i, $o, $org, $tel, $role, $activation);
                                session_destroy();
                        ?>
                                <div id="dark">
                                    <div id="darkwindow">
                                        <h2>Вы зарегистрировались! Письмо с активацией аккаунта выслано вам на почту!</h2> <br>
                                        <a href="index.php" class="close">Закрыть окно</a>
                                    </div>
                                </div>
                            <?php
                            } catch (Exception $e) {
                                // echo 'Message could not be sent.';
                                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                            ?>
                                <div id="dark">
                                    <div id="darkwindow">
                                        <h2>Не удалось отправить письмо с подтверждением, попробуйте еще раз!</h2> <br>
                                        <a href="reg.php#darkreg" class="close">Закрыть окно</a>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            session_destroy(); ?>
                            <div id="dark">
                                <div id="darkwindow">
                                    <h2>Такой логин уже есть</h2> <br>
                                    <a href="reg.php#darkreg" class="close">Закрыть окно</a>
                                </div>
                            </div>
                    <?php
                        }
                    }
                } else {
                    session_destroy(); ?>
                    <div id="dark">
                        <div id="darkwindow">
                            <h2>Заполните все поля!</h2> <br>
                            <a href="reg.php#darkreg" class="close">Закрыть окно</a>
                        </div>
                    </div>
                <?php }
                ?>
            </center>
        </div>
        <div class="footer">
            <center></center>
        </div>
    </div>
</body>

</html>