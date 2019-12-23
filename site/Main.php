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

					<a class="nav_link" href="service.php">Сервис</a>
					<a class="nav_link" href="info.php">Инфо</a>
					<a class="nav_link" href="forum.php">Форум</a>
					<a class="nav_link" href="logout.php">
						Выйти
					</a>
					<?php
					 if ($_SESSION['adm'] == 1) { ?>
					<a class="nav_link" href="111.php">БЕТА</a>
				<?php } ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="intro">
		<div class="container">
				<div class="intro_inners">
					<h1 class="intro_hello">Добро пожаловать в первое в СНГ сообщество, посвященное Dodge Challenger</h1>
               
                	<h2 class="intro_info">Здесь вы можете найти интересующую вас информацию в области техобслуживания, технических характеристи и опыта эксплуатации Dodge других автомобилистов</h2>
			    
					<h3 class="intro_drive">Если вы являетесь обладателем автомобиля Dodge Challenger вы можете связаться с нами в <a> групппе ВКонтакте</a> либо по адресу электронной почты: sna011rus@gmail.com для полученния дополнительных возможностей</h3>
			    </div>
		</div>
    </div>
</body>
</html>