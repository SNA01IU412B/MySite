<?php
	require('db.php');
	require("auth.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Shop</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/oldstyle.css" />
	<style>
		input {
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			display:block;
		}
	</style>
</head>
<body>
	<?php
	if(isSet($_SESSION['username'])){
		$two = $_SESSION["adm"];
		if($two!=1){
			echo "Denied";
			header("Location: login.php");
		}
	}
	?>
	<form method="post" enctype="multipart/form-data" > 
		<input type="text" name="stype" value="<?php if(isSet($_POST['stype'])){echo $_POST['stype'];}?>" placeholder="Тип">
		<input type="text" name="name" value="<?php if(isSet($_POST['name'])){echo $_POST['name'];}?>" placeholder="Назваание">
		<textarea name="descr" placeholder="Описание"></textarea>
		<input type="text" name="mnf" value="<?php if(isSet($_POST['mnf'])){echo $_POST['mnf'];}?>" placeholder="Производитель">
		<input type="text" name="tag" value="<?php if(isSet($_POST['tag'])){echo $_POST['tag'];}?>" placeholder="Цена">
		<input type="file" name="Изображение">
		<input type="hidden" name="doadd" value="1";>
		<input type="hidden" name="MAX_FILE_SIZE" value="3000">
		<input type="submit">
	</form>
	<?php
	if(!isset($_POST['doadd'])){
		exit(5);
	}
	$stype=$_POST['stype'];
	$name=$_POST['name'];
	$mnf=$_POST['mnf'];
	$tag=$_POST['tag'];
	$descr=$_POST['descr'];
	$dir='C:/Users/Home/xamp/htdocs/site/pictures/';
	$link=$dir . basename($_FILES['pic']['name']);
	$q="INSERT INTO products VALUES(DEFAULT,'$stype','$name','$mnf','$tag','$descr','$link',DEFAULT);";
 	copy($_FILES['pic']['tmp_name'],$link);
	mysqli_query(mysqli_connect('localhost','root','','shop'),$q);
	?>
</body>
</html>
