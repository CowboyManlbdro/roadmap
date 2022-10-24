<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Добавление файла</title>
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
        error_reporting(0);
        setlocale(LC_ALL, 'ru_RU');
$id= $_GET['id'];
$secid=$_POST['section'];
$secname=$_POST['sectiontext'];
$project= getProjectById($db, $id);


            

                $target_dir = 'docs/'.$project['name'].'/'.$secname.'/';

                if( isset($_FILES['sect']['name'])) {

                  $total_files = count($_FILES['sect']['name']);

                  for($key = 0; $key < $total_files; $key++) {

                    if(isset($_FILES['sect']['name'][$key]) 
                      && $_FILES['sect']['size'][$key] > 0) {



                      $original_filename = $_FILES['sect']['name'][$key];
                  $ext = pathinfo($original_filename, PATHINFO_EXTENSION);
                  $filename_without_ext = basename($original_filename, '.'.$ext);
                  $new_filename = $filename_without_ext . '_' . date("d.m.y") . '.' . $ext;
                  $nf =  $filename_without_ext . '_' . date("d.m.y");
                  $target = $target_dir . basename($original_filename);
                  $tmp  = $_FILES['sect']['tmp_name'][$key];
                  move_uploaded_file($tmp, $target_dir . $new_filename);
                  $loc=$target_dir . $new_filename;
                  $dl = date("Y-m-d");
                  
                  addFile($db, $nf, $ext, $id, $loc, $secid, $dl);

              }

          } ?>
          <div id="dark">
                        <div id="darkwindow">
                            <h2>Файлы успешно загружены!</h2> <br>
                            <a href="project.php?id=<?php echo $id;?>" class="close">Закрыть окно</a>
                            </div>
                    </div>
     <?php }

 ?>
			</center>

			

		</div>
		<div class="footer"><center>Ползунок</center></div>
	</div>

</body>

</html>

