<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Удаление файла</title>
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
$id= $_GET['id'];
    $file= getFileById($db, $id);
        unlink($file['location']);
         DelFile($db, $id);
?>
          <div id="dark">
                        <div id="darkwindow">
                            <h2>Файл удален!</h2> <br>
                            <a href="project.php?id=<?php echo $file['project'];?>" class="close">Закрыть окно</a>
                            </div>
                    </div>
    
			</center>

			

		</div>
		<div class="footer"><center>Ползунок</center></div>
	</div>

</body>

</html>

