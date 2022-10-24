<meta charset="utf-8">
<?php include 'connect.php';
include 'request.php';
addNotification($db,$_GET['id'],$_GET['section'],"содержит ошибки","#c91414");
SectionErrors($db,$_GET['id'],$_GET['section'],$_GET['error']);
echo true;
?>