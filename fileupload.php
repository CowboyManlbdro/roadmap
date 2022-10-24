<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Загрузка файлов</title>
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
                $np=$_POST['NameProject'];
                addProject($db,$np);
                $id=getProjectId($db,$np);
                $m = $_SESSION['mail'];
                addProjectAdmin($db,$id['id_p'],$m);
                for ($i = 1; $i <= 10; $i++){
                  addProjectSection($db,$id['id_p'],$i);
                }
                $sections = ["1.Подготовка производства","2.Получение исходных данных","3.Концепция проекта","4.Технологические решения","5.Блок-схема проекта","6.Технологическая-схема проекта","7.Баланс мощностей","8.Временная диаграмма","9.Детализация проекта","10.Аттестация проекта"];
                mkdir("docs/".$np);
                for ($i = 1; $i <= 10; $i++){ 
                  $section = $sections[$i-1];

                mkdir("docs/".$np."/".$section);

                $target_dir = 'docs/'.$np.'/'.$section.'/';

                if( isset($_FILES['section'.$i]['name'])) {

                  $total_files = count($_FILES['section'.$i]['name']);

                  for($key = 0; $key < $total_files; $key++) {

                    if(isset($_FILES['section'.$i]['name'][$key]) 
                      && $_FILES['section'.$i]['size'][$key] > 0) {



                      $original_filename = $_FILES['section'.$i]['name'][$key];
                  $ext = pathinfo($original_filename, PATHINFO_EXTENSION);
                  $filename_without_ext = basename($original_filename, '.'.$ext);
                  $new_filename = $filename_without_ext . '_' . date("d.m.y") . '.' . $ext;
                  $nf =  $filename_without_ext . '_' . date("d.m.y");
                  $target = $target_dir . basename($original_filename);
                  $tmp  = $_FILES['section'.$i]['tmp_name'][$key];
                  move_uploaded_file($tmp, $target_dir . $new_filename);
                  $loc=$target_dir . $new_filename;
                  $dl = date("Y-m-d");
                  
                  addFile($db, $nf, $ext, $id['id_p'], $loc, $i, $dl);
              }

          }

      }
                }
                

      ?>
      <label style="font-size: 30px;"> Проект успешно создан! </label> 
      <p><button class="btn-primary" onclick="window.location.href='project.php?id=<?php echo $id['id_p']; ?>'" >Открыть проект</button>
  </center>
</div>
<div class="footer"><center></center></div>
</div>
</body>
</html>