<?php
	require('db.php');
	require("auth.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Shop</title>
	<meta charset="utf-8">
	<style>
		input{display:block;}
	</style>
</head>
<body>
	<?php
	if(isSet($_SESSION['username'])){
		$dbc=mysqli_connect('localhost','root','','shop');
		$nick=$_SESSION['username'];
		$q="SELECT adm FROM users WHERE username='$nick'";
		$marr=mysqli_fetch_assoc(mysqli_query($dbc,$q));
		if($marr['adm']!=1){
			echo "Доступ запрещен";
			mysqli_close($dbc);
			exit(4);
		}
	} else {
		echo "Доступ запрещен";
		mysqli_close($dbc);
		exit(4);
	}
	?>
	<form method="post" enctype="multipart/form-data" > 
		<input type="text" name="stype" value="<?php if(isSet($_POST['stype'])){echo $_POST['stype'];}?>" placeholder="type">
		<input type="text" name="name" value="<?php if(isSet($_POST['name'])){echo $_POST['name'];}?>" placeholder="name">
		<textarea name="descr" placeholder="description"></textarea>
		<input type="text" name="mnf" value="<?php if(isSet($_POST['mnf'])){echo $_POST['mnf'];}?>" placeholder="manufacturer">
		<input type="text" name="tag" value="<?php if(isSet($_POST['tag'])){echo $_POST['tag'];}?>" placeholder="pricetag">
		<input type="file" name="pic">
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
	$dir='C:/Users/Home/xamp/htdocs';
	$link=$dir . basename($_FILES['pic']['name']);
	$q="INSERT INTO products VALUES(DEFAULT,'$stype','$name','$mnf','$tag','$descr','$link',DEFAULT);";
 	copy($_FILES['pic']['tmp_name'],$link);
	mysqli_query($dbc,$q);
	?>
</body>
</html>
