<?php

$user = "admin_roadmap";
$password = "";

try {
    $db=new PDO ("mysql:host=roadmap.tsput.ru;dbname=admin_roadmap",$user,$password);
    
} catch (Exception $e) {
   echo $e->getMessage();

}

?>