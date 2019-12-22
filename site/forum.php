<?php
require('db.php');
require("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:400,500,600i,700|Play:700&display=swap&subset=cyrillic-ext" rel="stylesheet">
	<title>ChallengerClub</title>
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="header_inner">
				<div class="header_logo">DODGE CHALLENGER</div>

				<nav>

					<a class="nav_link" href="Main.php">Главная</a>
					<a class="nav_link" href="service.php">Сервис</a>
					<a class="nav_link" href="info.php">Инфо</a>
					<a class="nav_link" href="logout.php">
						Выйти
					</a>
					<?php
					if ($_SESSION['adm'] == 1) { ?>

					<a class="nav_link" href="redactor.php">Редактор</a>
				<?php } ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="intro">
		<div class="container">
			<div class="forum_comment1">
				<?php
				$page_id = 150;// Уникальный идентификатор страницы (статьи или поста)
				$mysqli = new mysqli("localhost", "root", "", "comment");// Подключается к бд
				$result_set = $mysqli->query("SELECT * FROM `comment_table` WHERE `page_id`='$page_id'"); //Вытаскиваем все комментарии для данной страницы
				while ($row = $result_set->fetch_assoc()) {
				print_r("<b>".$row["name"]." пишет</b>:".
			    "<br>".
				$row["text_comment"]); //Вывод комментариев
				echo "<br />";
			}
			?>
		</div>
				<div class="intro_inners" flex="0 0 auto">
					<form name="comment" action="comment.php" method="post">
						<p>
							<label>Комментарий:</label>
							<br />
							<textarea name="text_comment" cols="70" rows="20"></textarea>
						</p>
						<p>
							<input type="hidden" name="page_id" value="150" />
							<input type="submit" value="Отправить" />
						</p>
					</form>
			    </div>
		</div>
    </div>
</body>
</html>