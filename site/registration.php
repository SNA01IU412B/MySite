<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Регистрация</title>
	<link rel="stylesheet" href="css/oldstyle.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates&display=swap&subset=cyrillic-ext" rel="stylesheet">
</head>
<body>
	<div class="main">
	<?php
		require('db.php');
		if (isset($_REQUEST['username'])){
		 $username = stripslashes($_REQUEST['username']);
		 $username = mysqli_real_escape_string($con,$username); 
		 $email = stripslashes($_REQUEST['email']);
		 $email = mysqli_real_escape_string($con,$email);
		 $password = stripslashes($_REQUEST['password']);
		 $password = mysqli_real_escape_string($con,$password);
		 $trn_date = date("Y-m-d H:i:s");
		        $query = "INSERT into `users` (username, password, email, trn_date)
		VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
		        $result = mysqli_query($con,$query);
		        if($result){
		            echo "<div class='form'><div class='block'>
		<h3>Вы успешно зарегистрировались.</h3>
		<br/>Нажмте здесь чтобы <a href='login.php'>войти</a></div></div>";
		        }
		    }else{
	?>
	<div class="form">
		<div class="block">
			<h1>Регистрация</h1>
			<form name="registration" action="" method="post">
				<input type="text" name="username" placeholder="Логин" required pattern="^[a-zA-Z]+$"/>
				<input type="email" name="email" placeholder="Email" required pattern="^.+@.+\..+$"/>
				<input type="password" name="password" placeholder="Пароль" required />
				<input type="submit" name="submit" value="Зарегистрироваться" />
				<p>Уже зарегистрированы? <a href='login.php' class="link">Войти</a></p>
			</form>
		</div>
	</div>
	<?php } ?>
</div>
</body>
</html>