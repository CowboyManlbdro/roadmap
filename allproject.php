<?php session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Проекты</title>
	<?php include ('link.php') ?>

</head>
<body>

	
	<div class="header">
		<?php include ('header.php'); ?>
	</div>

	<div class="content">
		<div class="center">
            <center>
            	
        <?php if (!empty($_SESSION)) { 
            if ($_SESSION['role'] == "admin") { 
                ?> <label style="font-size: 30px;"> Все проекты </label> <?php
                $projects = getAllProjects($db);
						foreach ($projects as $project) { ?>
                            <p><a href="project.php?id=<?php echo $project['id_p']; ?>"><label style="font-size: 20px;"><?php echo $project['name']; ?></label></a>
                       <?php }
            }
            else {
                $ids = getUserProject($db, $_SESSION['mail']);
                ?> <label style="font-size: 30px;"> Мои проекты </label> <?php
							if (!empty($ids)) {
								foreach ($ids as $id) {
									$projects = getProjectsById($db, $id);
									foreach ($projects as $project) { ?>
                                        <p><a href="project.php?id=<?php echo $project['id_p']; ?>"><label style="font-size: 20px;"><?php echo $project['name']; ?></label></a>
                                   <?php } 
                                } 
                            }
            }
        }
        ?>
        </center>
		</div>
	<div class="footer">
		<center>

		</center>	
	</div>
	</div>

</body>

</html>