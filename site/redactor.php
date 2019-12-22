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

					<a class="nav_link" href="forum.php">Форум</a>

				</nav>
			</div>
		</div>
	</header>
	<div class="intro">
		<div class="container">
				<div class="intro_inners">
					<?php
					$page_id = 150;// Уникальный идентификатор страницы (статьи или поста)
				$mysqli = new mysqli("localhost", "root", "", "comment");// Подключается к бд
				$result_set = $mysqli->query("SELECT * FROM `comment_table` WHERE `page_id`='$page_id'"); //Вытаскиваем все комментарии для данной страницы
				while ($row = $result_set->fetch_assoc()) {
				print_r("<b>id:". $row["id"]. "<br>". $row["name"]. "</b>:". $row["text_comment"]); //Вывод комментариев
					}?>
			    </div>
			    <div class="intro_inners">
			    	<form name="delete" action="delete.php" method="post">
			    		<p>
			    			<input type="text" name="id_comment" value="Ввести id комментария">
			    		</p>
			    		<p>
			    		<input type="submit" value="Удалить">
			    	    </p>
			    	</form>
			    </div>
		</div>
    </div>
</body>
</html>