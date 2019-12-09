<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
	<link rel="stylesheet" href="css/style.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates&display=swap&subset=cyrillic-ext" rel="stylesheet">
</head>
<body background="pk.jpg">
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
		<h3>You are registered successfully.</h3>
		<br/>Click here to <a href='login.php'>Login</a></div></div>";
		        }
		    }else{
	?>
	<div class="form">
		<div class="block">
			<h1>Registration</h1>
			<form name="registration" action="" method="post">
				<input type="text" name="username" placeholder="Username" required pattern="^[a-zA-Z]+$"/>
				<input type="email" name="email" placeholder="Email" required pattern="^.+@.+\..+$"/>
				<input type="password" name="password" placeholder="Password" required />
				<input type="submit" name="submit" value="Register" />
				<p>Registered yet? <a href='login.php' class="link">Login Here</a></p>
			</form>
		</div>
	</div>
	<?php } ?>
</body>
</html>