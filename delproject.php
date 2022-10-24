<?php session_start(); 
error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<title>Удаление проекта</title>
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
     $files = getFilesByProject($db,$id);
     $project= getProjectById($db, $id);
     foreach ($files as $file) {
        unlink($file['location']);
    }	
    	rmdir("docs/". $project['name'] ."/1.Подготовка производства");
    	rmdir("docs/". $project['name'] ."/2.Получение исходных данных");
    	rmdir("docs/". $project['name'] ."/3.Концепция проекта");
    	rmdir("docs/". $project['name'] ."/4.Технологические решения");
    	rmdir("docs/". $project['name'] ."/5.Блок-схема проекта");
    	rmdir("docs/". $project['name'] ."/6.Технологическая-схема проекта");
    	rmdir("docs/". $project['name'] ."/7.Баланс мощностей");
    	rmdir("docs/". $project['name'] ."/8.Временная диаграмма");
    	rmdir("docs/". $project['name'] ."/9.Детализация проекта");
    	rmdir("docs/". $project['name'] ."/10.Аттестация проекта");
    	 rmdir("docs/".$project['name']);
         DelProject($db, $id);
?>
          <div id="dark">
                        <div id="darkwindow">
                            <h2>Проект удален!</h2> <br>
                            <a href="index.php" class="close">Закрыть окно</a>
                            </div>
                    </div>
    
			</center>

			

		</div>
		<div class="footer"><center>Ползунок</center></div>
	</div>

</body>

</html>

