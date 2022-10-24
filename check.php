<meta charset="utf-8">
<?php include 'connect.php';
include 'request.php';
addNotification($db,$_GET['id'],$_GET['section'],"отправлен на проверку","yellow");
SectionCheck($db,$_GET['id'],$_GET['section']);
echo true;
?>