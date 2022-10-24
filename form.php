<div id="beg">
	<label>Здравствуйте, <?php echo $_SESSION['i'], ' ', $_SESSION['o']; ?></label>
	<p>
		<button class="btn-primary" onclick="see(document.getElementById('blockform'),document.getElementById('beg'))">Создать проект</button>
		<?php if ($_SESSION['role'] == "admin") { ?>
			<button class="btn-primary" onclick="window.location.href='allproject.php'">Все проекты</button>
		<?php } else { ?>
			<button class="btn-primary" onclick="window.location.href='allproject.php'">Мои проекты</button>
		<?php } ?>
		
		<?php
		$ids = getUserProject($db, $_SESSION['mail']);
		if (!empty($ids)) { ?>
		<p>
		<label style="font-size: 35px;">Пока вас не было</label>
		<p>
		<?php
			foreach ($ids as $id) {
				$projects = getProjectsById($db, $id);
				foreach ($projects as $project) {
		?>
					<label style="font-size: 25px;">В проекте </label><a href="project.php?id=<?php echo $project['id_p']; ?>"><label style="font-size: 25px;"> <?php echo $project['name']; ?></label></a>
					<?php
					$nots = getNotifications($db,$id);
					if (!empty($nots)) {
					foreach ($nots as $not) { ?>
						<p><label >Этап <?php echo $not['id_section'] ?> <label style="color: <?php echo $not['color']?>;"> <?php echo $not['text'] ?></label></label>
					<?php } }
					else {
					 ?>
						<p><label >Ничего не произошло</label></label>
				<?php } } ?>


		<?php }
		} ?>
</div>

<div class="forform" id="blockform" style="display: none;">
	<form id="form" action="fileupload.php" method="post" enctype="multipart/form-data"></form>

	<div id="level1" class="beg">
		<div class="label">
			<label>Начало</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Здесь можно загрузить все нужные файлы для подачи проекта</label>
			</div>
		</div>
		<div class="forms">

		</div>
		<div class="buttons">

			<div class="start">
				<button onclick="see(document.getElementById('level2'),document.getElementById('level1'))"><label>Начать</label></button>
			</div>

		</div>

	</div>

	<div id="level2" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №1: Название проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Введите название вашего проекта</label>
				<input type="text" name="NameProject" form="form">
			</div>
		</div>
		<div class="forms">

		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level1'),document.getElementById('level2'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level2dop'),document.getElementById('level2'))"><label>Далее</label></button>
			</div>

		</div>
	</div>

	<div id="level2dop" class="beg" style="display: none;">
		<div class="label">
			<label>Добавление фалов</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Будете добавлять файлы проекта сразу?</label>
			</div>
		</div>
		<div class="forms">

		</div>
		<div class="buttons">
			<div class="prev">
				<button type="submit" form="form"><label>Нет</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level3'),document.getElementById('level2dop'))"><label>Да</label></button>
			</div>

		</div>
	</div>

	<div id="level3" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №2: Подготовка производства</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Прикрепите файл Разделение ответственности. Ссылки на правильное оформление данного документа:
					<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 4</a>
				</label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files1">Обзор</a>
					<input type="file" name="section1[]" id="comment-files1" form="form" multiple>
				</div>
				<ul id="attached-fiels-list1" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level2dop'),document.getElementById('level3'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level4'),document.getElementById('level3'))"><label>Далее</label></button>
			</div>
		</div>
	</div>

	<div id="level4" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №3: Получение исходных данных</label>
		</div>
		<div class="desc">
			<div class="filecount">
				<label>Прикрепите 3 файла: <p>1.Задание на проектирование
					<p>2.Промышленный регламент
					<p>3.Условия на подключение
				</label>
			</div>
			<div class="gosts">
				<label>Ссылки на правильное оформление данных файлов:<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 5</a>
					<p><a href="https://docs.cntd.ru/document/1200086244"> Гост 3.1001-2011 </a>
					<p><a href="https://docs.cntd.ru/document/901968253 "> Постановление от 13 февраля 2006 года №83 </a>
				</label>

			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files2">Обзор</a>
					<input type="file" name="section2[]" id="comment-files2" form="form" multiple>
				</div>
				<ul id="attached-fiels-list2" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level3'),document.getElementById('level4'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level5'),document.getElementById('level4'))"><label>Далее</label></button>
			</div>
		</div>
	</div>

	<div id="level5" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №4: Концепция проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Ссылки на правильное оформление концепции:<p><a href="https://docs.cntd.ru/document/1200032260#7d20k3">Гост исо 14644-1-2002 </a></label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files3">Обзор</a>
					<input type="file" name="section3[]" id="comment-files3" form="form" multiple>
				</div>
				<ul id="attached-fiels-list3" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level4'),document.getElementById('level5'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level6'),document.getElementById('level5'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level6" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №5: Технологические решения</label>
		</div>
		<div class="desc">
			<div class="filecount">
				<label>Прикрепите 2 файла: <p>1.Пояснительная записка проекта
					<p>2.Технологические решения
				</label>
			</div>
			<div class="gosts">
				<label>Ссылки на правильное оформление данных файлов:<p><a href="https://docs.cntd.ru/document/1200007671">Гост 19.404-79 пояснительная записка </a>
					<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 7.2</a>
				</label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files4">Обзор</a>
					<input type="file" name="section4[]" id="comment-files4" form="form" multiple>
				</div>
				<ul id="attached-fiels-list4" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level5'),document.getElementById('level6'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level7'),document.getElementById('level6'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level7" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №6: Блок-схема проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Ссылки на правильное оформление блок-схемы:<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 7.3</a></label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files5">Обзор</a>
					<input type="file" name="section5[]" id="comment-files5" form="form" multiple>
				</div>
				<ul id="attached-fiels-list5" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level6'),document.getElementById('level7'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level8'),document.getElementById('level7'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level8" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №7: Тех-схема проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Ссылки на правильное оформление тех-схемы:<p><a href="https://docs.cntd.ru/document/871001066#7d20k3">Гост 21.401-88</a>
					<p><a href="https://docs.cntd.ru/document/1200107995">Гост 21.110-2013 </a>
					<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 7.4</a>
				</label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files6">Обзор</a>
					<input type="file" name="section6[]" id="comment-files6" form="form" multiple>
				</div>
				<ul id="attached-fiels-list6" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level7'),document.getElementById('level8'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level9'),document.getElementById('level8'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level9" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №8: Баланс мощностей проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Ссылки на правильное оформление баланса мощностей:<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 7.6</a></label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files7">Обзор</a>
					<input type="file" name="section7[]" id="comment-files7" form="form" multiple>
				</div>
				<ul id="attached-fiels-list7" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level8'),document.getElementById('level9'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level10'),document.getElementById('level9'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level10" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №9: Временная диаграмма проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Ссылки на правильное оформление диаграммы:<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 7.7</a></label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files8">Обзор</a>
					<input type="file" name="section8[]" id="comment-files8" form="form" multiple>
				</div>
				<ul id="attached-fiels-list8" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level9'),document.getElementById('level10'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level11'),document.getElementById('level10'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level11" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №10: Детализация проекта</label>
		</div>
		<div class="desc">
			<div class="filecount">
				<label>Прикрепите 8 файлов: <p>1.Вспомогательные помещения 2.Отходы 3.Планировочные решения 4.Склады 5.Требования к оборудованию 6.Требования к одежде 7.Численность персонала 8.Чистые помещения </label>
			</div>
			<div class="gosts">
				<label>Ссылки на правильное оформление данных файлов:<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 7.10 - 7.15</a>
					<p><a href="https://docs.cntd.ru/document/1200028831">Гост 30772-2001 раздел 7.4</a>
					<p><a href="https://docs.cntd.ru/document/1200008166#7d20k3">Снип 31-04-2001</a>
					<p><a href="https://docs.cntd.ru/document/1200107995">Гост 21.110-2013</a>
					<p><a href="https://docs.cntd.ru/document/1200044475">Гост р 52538-2006</a>
				</label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files9">Обзор</a>
					<input type="file" name="section9[]" id="comment-files9" form="form" multiple>
				</div>
				<ul id="attached-fiels-list9" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="prev">
				<button onclick="see(document.getElementById('level10'),document.getElementById('level11'))"><label>Назад</label></button>
			</div>

			<div class="next">
				<button onclick="see(document.getElementById('level12'),document.getElementById('level11'))"><label>Далее</label></button>
			</div>
		</div>
	</div>


	<div id="level12" class="beg" style="display: none;">
		<div class="label">
			<label>Этап №11: Аттестация проекта</label>
		</div>
		<div class="desc">
			<div class="all">
				<label>Ссылки на правильное оформление аттестации:<p><a href="https://docs.cntd.ru/document/1200124955">Гост р 56639-2015 раздел 9</a></label>
			</div>
		</div>
		<div class="forms">
			<div class="upload">
				<div class="drop">
					<a id="add-comment-files10">Обзор</a>
					<input type="file" name="section10[]" id="comment-files10" form="form" multiple>
				</div>
				<ul id="attached-fiels-list10" style="display: none;">
				</ul>
			</div>
		</div>
		<div class="buttons">
			<div class="finish">
				<button type="submit" form="form"><label>Закончить</label></button>
			</div>
		</div>
	</div>


</div>