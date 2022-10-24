<?php session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Проект</title>
    <?php include('link.php') ?>

</head>

<body>
    <div class="header">
        <?php include('header.php'); ?>
    </div>

    <div class="content">
        <div class="center">
            <div class="project">

                <?php
                $id = $_GET['id'];
                if ($id) {
                    $project = getProjectById($db, $id);
                    $admin_project = getProjectAdmin1($db, $id);
                    $project_workers = getProjectWorker($db, $id);
                } else {
                    echo "<h1>Ошибка</h1>";
                    exit();
                }
                if (isAdmin($db, $id, $_SESSION['mail'])) {
                    $admin = 1;
                    $worker = 0;
                } else {
                    if (isWorker($db, $id, $_SESSION['mail'])) {
                        $worker = 1;
                    }
                    $admin = 0;
                }
                ?>

                <div class="descproj">
                    <h1 class="namepr"><? echo $project['name']; ?></h1>

                    <?php if ($_SESSION['role'] == "admin") { ?>
                        <p><button class="btn-primary" onclick="window.location.href='delproject.php?id=<?php echo $id; ?>#dark'">Удалить проект</button>
                        <?php } ?>
                        <p><select name="section" type="text" id="sec" onchange="sec()">
                                <option selected disabled="disabled" value="0">Выберете раздел</option>;
                                <option value="1">1.Подготовка производства</option>;
                                <option value="2">2.Получение исходных данных</option>;
                                <option value="3">3.Концепция проекта</option>;
                                <option value="4">4.Технологические решения</option>;
                                <option value="5">5.Блок-схема проекта</option>;
                                <option value="6">6.Технологическая-схема проекта</option>;
                                <option value="7">7.Баланс мощностей</option>;
                                <option value="8">8.Временная диаграмма</option>;
                                <option value="9">9.Детализация проекта</option>;
                                <option value="10">10.Аттестация проекта</option>;
                            </select>

                </div>

                <div class="filetab">

                    <div id="sec0">
                        <label>Здесь появятся файлы</label>
                    </div>

                    <?php
                    for ($i = 1; $i <= 10; $i++) { ?>

                        <div id="sec<?php echo $i; ?>" class="files" style="display: none;">
                            <div class="info">

                                <div class="notifications">
                                    <h1>Информация о выполнении</h1>
                                    <h2 id="stadia<?php echo $i; ?>"></h2>
                                    <h3 id="errors<?php echo $i; ?>"></h3>
                                </div>
                                <div class="filesandgost">
                                     <div class="gost">
                                         <? $gosty = getSectionGost($db,$i); ?>
                                <h1>ГОСТЫ</h1>
                                <?php $k = 1;
                                foreach ($gosty as $gost){ ?>
                                    <a href="<?php echo $gost['link']; ?>"><h2><?php echo "$k. "; echo $gost['nameGost']; ?></h2></a>
                                <?php $k++; } ?>
                                </div>
                                <div class="f">
                                <h1>загруженные файлы</h1>
                                    <center>
                                        <table>
                                            <?php $files = getFilesByProjectAndSection($db, $id, $i);

                                            foreach ($files as $file) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($file['ext'] == "docx") {
                                                        ?>
                                                            <img class="imgfile" src="img/word.png">
                                                    </td>
                                                <?php }
                                                        if ($file['ext'] == "pdf") { ?>

                                                    <img class="imgfile" src="img/pdf.png" >
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <label><?php echo $file['name_file']; ?></label>
                                                </td>
                                                <td>
                                                    <button class="btn-load" onclick="window.location.href='<?php echo $file['location']; ?>'"></button>
                                                </td>
                                                <?php if (($admin == 1) || ($worker = 1)) { ?>
                                                    <td>
                                                        <button class="btn-del" onclick="window.location.href='delfile.php?id=<?php echo $file['id_f']; ?>#dark'"></button>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                            <?php } ?>

                                        </table>
                                    </center>
                                </div>
                               
                                </div>

                                <div class="workers">
                                    <h1>Руководитель проекта</h1>
                                    <h2> <?php echo $admin_project['f'], " ", $admin_project['i'], " ", $admin_project['o'] ?></h2>
                                    <h3><?php echo $admin_project['tel'] ?></h3>
                                    <h3><?php echo $admin_project['mail'] ?></h3>
                                    <h1>Сотрудники</h1>
                                    <?php
                                    foreach ($project_workers as $pr_worker) {
                                        $work = getUserInfo($db, $pr_worker['mail']);
                                        if ($work['activation']==0){ ?>
                                            <h2>Пользователь приглашен, но еще не зарегистрировался</h2>
                                            <h3><?php echo $work['mail'] ?></h3>
                                      <?php  } else {
                                    ?>
                                        <h2> <?php echo $work['f'], " ", $work['i'], " ", $work['o'] ?></h2>
                                        <h3><?php echo $work['tel'] ?></h3>
                                        <h3><?php echo $work['mail'] ?></h3>
 
                                    <?php }  }
                                    ?>
                                </div>

                            </div>
                            <div class="button_info">
                                <div class="btnErrorCorrect">
                                    <?php if ($admin == 1) { ?>
                                        <button id="GoError<?php echo $i; ?>" class="btn-primary" onclick="openform(document.getElementById('darkError'))" style="display: none;">Указать ошибки</button>
                                        <button id="Ready<?php echo $i; ?>" class="btn-primary" onclick="correct()" style="display: none;">Выполнено!</button>
                                    <?php } ?>
                                    <?php if ($worker == 1) { ?>
                                        <button id="GoOnCheck<?php echo $i; ?>" class="btn-primary" onclick="check()" style="display: none;">Отправить на проверку</button>
                                    <?php } ?>
                                </div>
                                <div class="badd">
                                    <button class="btn-primary" onclick="openform(document.getElementById('darkadd'))">Добавить файл в раздел</button>

                                </div>
                                <div class="addWorker">
                                    <button class="btn-primary" onclick="openform(document.getElementById('darkaddad'))">Пригласить/Удалить сотрудника</button>
                                </div>
                            </div>
                        </div>


                    <?php }
                    ?>

                </div>


            </div>


            <div id="darkadd" style="display: none;">
                <div id="darkwindowadd">
                    <form id="add" method="post" action="addfile.php?id=<?php echo $id; ?>#dark" enctype="multipart/form-data"> </form>
                    <center>
                        <table>

                            <tr>
                                <td colspan="2" align="center">
                                    <label>Выберете файлы</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">

                                    <input id="secinp" form="add" type="text" name="section" style="display: none;">
                                    <input id="sectext" form="add" type="text" name="sectiontext" style="display: none;">

                                    <div class="upload">
                                        <div class="drop">
                                            <button class="btn-primaryreg" id="addf">Обзор</button>
                                            <input type="file" name="sect[]" id="files" form="add" multiple>
                                        </div>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <ul id="list" class="l" style="display: none;">
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <button class="btn-primaryreg" type="submit" form="add">Загрузить</button>
                                </td>
                </div>

                <td align="center">
                    <button class="btn-primary" onclick="openform(document.getElementById('darkadd'))">Закрыть окно</button>
                </td>
                </tr>

                </table>
                </center>
            </div>
        </div>



        <div id="darkaddad" style="display: none;">
            <div id="darkwindowaddad">
                <form id="addadmin" method="post" action="addprojectadmin.php?id=<?php echo $id; ?>#dark" enctype="multipart/form-data"> </form>
                <center>
                    <table>

                        <tr>
                            <td colspan="2" align="center">
                                <label>Введите электронную почту сотрудника</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">

                                <input id="" form="addadmin" type="text" name="email">
                            </td>
                        </tr>

                        <tr>
                            <td align="center">
                                <button class="btn-primaryreg" type="submit" form="addadmin">Отправить приглашение</button>
                            </td>


                            <td align="center">
                                <button class="btn-primary" onclick="openform(document.getElementById('darkaddad'))">Закрыть окно</button>
                            </td>
                        </tr>

                    </table>
                </center>
            </div>
        </div>

        <div id="darkError" style="display: none;">
            <div id="darkwindowError">
                <!-- <form id="addError" method="post" action="addError.php?id=<?php echo $id; ?>#dark" enctype="multipart/form-data"> </form> -->
                <center>
                    <table>

                        <tr>
                            <td colspan="2" align="center">
                                <label>Введите ошибки, допущенные в заполнении файлов на данном этапе</label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">

                                <textarea id="inputError"  name="errors"></textarea> 
                            </td>
                        </tr>

                        <tr>
                            <td align="center">
                                <button class="btn-primaryreg" type="submit" onclick="addErrors()">Отправить</button>
                            </td>


                            <td align="center">
                                <button class="btn-primary" onclick="openform(document.getElementById('darkError'))">Закрыть окно</button>
                            </td>
                        </tr>

                    </table>
                </center>
            </div>
        </div>



    </div>
    <div class="footer">
        <center>
            <div id="flat-slider"></div>
        </center>
    </div>
    </div>

    <script type="text/javascript">
        var i = 0;

        function sec() {
            var e = document.getElementById("sec");
            var valsec = e.options[e.selectedIndex].value;
            $("#flat-slider").slider('value', valsec);
        }
    </script>

<script>//окрашиваем блок с информацией в красный и добаляем ошибки
    function addErrors() { 
            var valslid = $("#flat-slider").slider('option', 'value');
            $.ajax({
                type: "GET",
                url: "errors.php",
                data: ({
                    id: <?php echo $id ?>,
                    section: valslid,
                    error: $("#inputError").val()
                }),
                success: function(data) {
                    $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                        'background-color': 'red'
                    })
                    $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                        'color': 'red'
                    })
                    $('.notifications').css({
                        'background-color': 'rgb(255 0 0 / 50%)'
                    })
                    $('#stadia' + valslid).text('Данный этап содержит ошибки:')
                    $("#flat-slider").slider('value', valslid);
                    $("#inputError").val('');
                    openform(document.getElementById('darkError'));
                }
            });
            
        };
</script>

<script> //окрашиваем блок с информацией в зеленый
    function check() { 
            var valslid = $("#flat-slider").slider('option', 'value');
            $.ajax({
                type: "GET",
                url: "check.php",
                data: ({
                    id: <?php echo $id ?>,
                    section: valslid
                }),
                success: function(data) {
                    $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                        'background-color': 'yellow'
                    })
                    $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                        'color': 'yellow'
                    })
                    $('.notifications').css({
                        'background-color': 'rgb(255 255 0 / 49%)'
                    })
                    $('#stadia' + valslid).text('Данный этап находится на проверке')
                    $('#errors' + valslid).text('')
                    $('#GoOnCheck' + valslid).fadeOut(500)
                }
            });
            
        };
</script>

    <script> //окрашиваем блок с информацией в зеленый
    function correct() { 
            var valslid = $("#flat-slider").slider('option', 'value');
            $.ajax({
                type: "GET",
                url: "ready.php",
                data: ({
                    id: <?php echo $id ?>,
                    section: valslid
                }),
                success: function(data) {
                    $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                        'background-color': 'green'
                    })
                    $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                        'color': 'green'
                    })
                    $('.notifications').css({
                        'background-color': 'rgb(0 128 0 / 50%)'
                    })
                    $('#stadia' + valslid).text('Данный этап заполнен верно')
                    $('#GoError' + valslid).fadeOut(500)
                    $('#Ready' + valslid).fadeOut(500)
                }
            });
            
        };
    </script>

    <script> //изменение цвета слайдера
        function en() {
            $("#flat-slider").slider("enable");
        }
        $("#flat-slider").on("slidechange", function(e, ui) {
            var e = document.getElementById("sec");
            var valsec = e.options[e.selectedIndex].value;
            var valslid = $("#flat-slider").slider('option', 'value');
            document.getElementById("sec").value = valslid;

            $.ajax({
                type: "GET",
                url: "color.php",
                data: ({
                    id: <?php echo $id ?>,
                    section: valslid
                }),
                success: function(data) {
                    data = JSON.parse(data);
                    if ((data[1] == 0) && (data[2] == 0) && (data[3] == 0)) {
                        $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                            'background-color': '#1480c0'
                        })
                        $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                            'color': '#1480c0'
                        })
                        $('.notifications').css({
                            'background-color': 'transparent'
                        })
                        $('#stadia' + valslid).text('Данный этап не отправлен на проверку')
                        $('#GoOnCheck' + valslid).fadeIn(100)
                    } else {
                        if (data[1] == 1) {

                            $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                                'background-color': 'red'
                            })
                            $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                                'color': 'red'
                            })
                            $('.notifications').css({
                                'background-color': 'rgb(255 0 0 / 50%)'
                            })
                            $('#stadia' + valslid).text('Данный этап содержит ошибки:')
                            $('#errors' + valslid).text(data[4])
                            $("#inputError").val(data[4]);
                            $('#GoError' + valslid).fadeIn(100)
                            $('#Ready' + valslid).fadeIn(100)
                            $('#GoOnCheck' + valslid).fadeIn(100)
                        } else {
                            if (data[2] == 1) {
                                $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                                    'background-color': '#ffff00'
                                })
                                $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                                    'color': '#ffff00'
                                })
                                $('.notifications').css({
                                    'background-color': 'rgb(255 255 0 / 49%)'
                                })
                                $('#stadia' + valslid).text('Данный этап находится на проверке')
                                $("#inputError").val(data[4]);
                                $('#GoError' + valslid).fadeIn(100)
                                $('#Ready' + valslid).fadeIn(100)
                            } else {
                                if (data[3] == 1) {
                                    $('#flat-slider .ui-slider-handle, #flat-slider .ui-slider-range, #flat-slider .ui-slider-pip[class*=ui-slider-pip-selected] .ui-slider-line, #flat-slider .ui-slider-pip.ui-slider-pip-inrange .ui-slider-line').css({
                                        'background-color': 'green'
                                    })
                                    $('.ui-slider-pips [class*=ui-slider-pip-selected]').css({
                                        'color': 'green'
                                    })
                                    $('.notifications').css({
                                        'background-color': 'rgb(0 128 0 / 50%)'
                                    })
                                    $('#stadia' + valslid).text('Данный этап заполнен верно')
                                }
                            }
                        }
                    }
                }
            });
            var textsec = e.options[e.selectedIndex].text;
            document.getElementById('sectext').value = textsec;
            see(document.getElementById("sec" + valslid), document.getElementById("sec" + i));
            $("#flat-slider").slider("disable");
            setTimeout(en, 1000);
            i = valslid;
            document.getElementById('secinp').value = i;

        });
    </script>
</body>

</html>