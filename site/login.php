<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/oldstyle.css" />
</head>
<body>

<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
 $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
 $username = mysqli_real_escape_string($con,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($con,$password);
 //Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
 $result = mysqli_query($con,$query) or die(mysql_error());
 $rows = mysqli_num_rows($result);
        if($rows==1){
     $_SESSION['username'] = $username;
            // Редирект
     header("Location: main.html");
         }else{
 echo "<div class='form'>
<h3>Пароль или логин введен неверно.</h3>
<br/>Нажмите здесь чтобы <a href='login.php'>войти повторно</a></div>";
 }
    }else{
?>
<div class="form">
<h1>Вход</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Логин" required />
<input type="password" name="password" placeholder="Пароль" required />
<input name="submit" type="submit" value="Войти" />
</form>
<p>Еще не зарегистрированы? <a href='registration.php'>Зарегистрироваться здесь</a></p>
</div>
<?php } ?>
</body>
</html>