<?php include 'connect.php';
include 'request.php';
?>

<div class="menu">

	<ul class="topmenu">

		<?php if (!empty($_SESSION)) {
			if ($_SESSION['role'] == "admin") { ?>
				<li><a href="" class="active">Все проекты<span class="fa fa-angle-down"></span></a>
					<ul class="submenu">
						<?php
						$projects = getAllProjects($db);
						foreach ($projects as $project) {
						?>
							<li><a href="project.php?id=<?php echo $project['id_p']; ?>"><?php echo $project['name']; ?></a></li>

						<?php } ?>
					</ul>
				</li>
				<?php } else {
				if ($_SESSION['role'] == "user") {
				?>
					<li><a href="" class="active">Мои проекты<span class="fa fa-angle-down"></span></a>
						<ul class="submenu">
							<?php
							$ids = getUserProject($db, $_SESSION['mail']);
							if (!empty($ids)) {
								foreach ($ids as $id) {
									$projects = getProjectsById($db, $id);
									foreach ($projects as $project) {
							?>
										<li><a href="project.php?id=<?php echo $project['id_p']; ?>"><?php echo $project['name']; ?></a></li>

									<?php } ?>


							<?php }
							} ?>
						</ul>
					</li>
				<?php }  ?>


			<?php }
		} else { ?>
			<li><a href="" class="active">Дорожная карта<span class="fa fa-angle-down"></span></a>
				<ul class="submenu">

				</ul>
			</li>
		<?php } ?>
	</ul>
</div>

<div class="logo">
	<center>
		<a href="index.php"><img src="img/logotspu.png"></a>
	</center>
</div>
<div class="auth">
	<div id="opbut">
		<center>
			<?php if (!empty($_SESSION)) {
			?>
				Пользователь: <?php echo $_SESSION['f'], ' ', $_SESSION['i'], ' ', $_SESSION['o']; ?>
				<button class="btn-login" id="open-button" onclick="window.location.href='logout.php#dark'"><b>ВЫЙТИ</b></button>
			<?php } else {
			?>
				<button class="btn-login" id="open-button" onclick="auth(document.getElementById('fauth'))"><b>ВОЙТИ</b></button>
			<?php } ?>
		</center>
	</div>
	<form id="formlog" method="post" action="login.php#dark"></form>
	<div id="fauth" style="display: none;">
		<div id="in">
			<div id="inp">
				<center><label>Логин</label></center>
				<input type="text" name="log" form="formlog">
				<center><label>Пароль</label></center>
				<input type="password" name="pass" form="formlog">
			</div>
			<div id="closed">
				<button id="btn-close" onclick="auth(document.getElementById('fauth'))"><img src="img/close.png"></button>
			</div>
		</div>
		<div id="authbut">
			<div id="logbut">
				<button class="btn-log" form="formlog"><b>ВОЙТИ</b></button>
			</div>
			<div id="regbut">
				<button class="btn-reg" onclick="window.location.href='reg.php#darkreg'"><b>РЕГИСТРАЦИЯ</b></button>
			</div>
		</div>
	</div>


</div>