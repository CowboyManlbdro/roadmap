<?php include 'connect.php';
include 'request.php';

$section_info = getSectionInfo($db,$_GET['id'],$_GET['section']);
echo json_encode(array("1" => $section_info['error'], "2" => $section_info['on_check'], "3" => $section_info['correctly'], "4" => $section_info['errors']));
?>