<?php session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php'; ?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <title>Добавление сотрудника</title>
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
                $id = $_GET['id'];
                $project = getProjectById($db, $id);
                if ($_POST['email'] != '') {
                    $email = $_POST['email'];
                    if (IsProjectWorker($db, $id, $email)) {
                        DelProjectWorker($db, $id, $email);
                ?>

                        <div id="dark">
                            <div id="darkwindow">
                                <h2>Пользователь откреплен от проекта!</h2> <br>
                                <a href="project.php?id=<?php echo $id; ?>" class="close">Закрыть окно</a>
                            </div>
                        </div>



                        <?php
                    } else {
                        addProjectPeople($db, $id, $email);
                        if (LoginFree($db, $email)) {
                            $hash = md5($email . time());

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
                                $mail->addAddress($email);              // Name is optional

                                //Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Приглашение к проекту';
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
                                  <h3 style="font-family:"Arial, Helvetica, sans-serif; color: #1480c0;">Вы были приглашены к проекту! <br>Завершите регистрацию, нажав на кнопку ниже!</h3>
                                 </td>
                                </tr>
                                <tr>
                                 <td align="center">
                                 <div><!--[if mso]>
                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:53px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#1480c0">
                                        <w:anchorlock/>
                                        <center>
                                                    <![endif]-->
                                         <a href="http://roadmap.tsput.ru//regInvite.php?hash=' . $hash . '&mail=' . $email . '#darkreg"
                                        style="background-color:#1480c0;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:53px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">ЗАРЕГИСТРИРОВАТЬСЯ</a>
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
                                $mail->AltBody = '<p>Вы приглашены к проекту, перейдите по <a href="http://roadmap.tsput.ru//regInvite.php?hash=' . $hash . '&mail=' . $email . '#darkreg">ссылке </a> и закончите регистрацию</p>';

                                $mail->send();
                                // echo 'Message has been sent';
                                addUser($db, $email, "Нет", $hash, "Нет", "Нет", "Нет", "Нет", "Нет", "user", 0);

                        ?>

                                <div id="dark">
                                    <div id="darkwindow">
                                        <h2>Приглашение отправлено сотруднику на почту!</h2> <br>
                                        <a href="project.php?id=<?php echo $id; ?>" class="close">Закрыть окно</a>
                                    </div>
                                </div>



                            <?php
                            } catch (Exception $e) {
                                // echo 'Message could not be sent.';
                                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                            ?>
                                <div id="dark">
                                    <div id="darkwindow">
                                        <h2>Не удалось отправить письмо с пприглашением, попробуйте еще раз!</h2> <br>
                                        <a href="project.php?id=<?php echo $id; ?>" class="close">Закрыть окно</a>
                                    </div>
                                </div>
                            <?php
                            }

                            // 

                        } else {
                            ?>

                            <div id="dark">
                                <div id="darkwindow">
                                    <h2>Пользователь добавлен к проекту!</h2> <br>
                                    <a href="project.php?id=<?php echo $id; ?>" class="close">Закрыть окно</a>
                                </div>
                            </div>



                    <?php
                        }
                    }
                } else { ?>
                    <div id="dark">
                        <div id="darkwindow">
                            <h2>Введите электронную почту!</h2> <br>
                            <a href="project.php?id=<?php echo $id; ?>" class="close">Закрыть окно</a>
                        </div>
                    </div>
                <?php
                }

                ?>
            </center>
        </div>
        <div class="footer">
            <center>Ползунок</center>
        </div>
    </div>

</body>

</html>