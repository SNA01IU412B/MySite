<?php
	session_start();
	$id=$_GET['prid'];
	$rtng=$_POST['strs'];
	if(($_POST['rate']==1)&(isset($_SESSION['username']))){
		$rtng=($rtng+mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT rtng FROM products WHERE id='$id';"))['rtng'])/2;
		mysqli_query(mysqli_connect('localhost','root','','shop'),"UPDATE products SET rtng='$rtng' WHERE id='$id';");
	}
	$nick=$_SESSION['username'];
	if((mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','register'),"SELECT adm FROM users WHERE username='$nick';"))['adm']==1)&($_POST['dochg'])){
		$stype=$_POST['stype'];
		$name=$_POST['name'];
		$descr=$_POST['descr'];
		$mnf=$_POST['mnf'];
		$tag=$_POST['tag'];
		mysqli_query(mysqli_connect('localhost','root','','shop'),"UPDATE products SET styp='$stype',name='$name',mnf='$mnf',pricetag='$tag',descr='$descr' WHERE id='$id';");
		if(isset($_POST['dopic'])){
			unlink(substr(mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT link FROM products WHERE id='$id';"))['link'],40));
			$link="C:\Users\Home\xamp\htdocs\site\pictures" . basename($_FILES['pic']['name']);
			copy($_FILES['pic']['tmp_name'],$link);
			mysqli_query(mysqli_connect('localhost','root','','shop'),"UPDATE products SET link='$link' WHERE id='$id';");
		}
	}
	if(($_POST['docmnt'])&(isset($_SESSION['username']))){
		$text=$_POST['cmnt'];
		$cid=mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT cid FROM comments WHERE pid='$id' ORDER BY cid DESC;"))['cid'];
		if(!isset($cid)){
			$cid=0;
		}
		$cid=$cid+1;
		mysqli_query(mysqli_connect('localhost','root','','shop'),"INSERT INTO comments VALUES(DEFAULT,'$cid','$id','$nick','$text');");
	}
	if((mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','register'),"SELECT adm FROM users WHERE username='$nick';"))['adm']==1)&($_POST['dodrop'])){
		unlink(substr(mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT link FROM products WHERE id='$id';"))['link'],40));
		mysqli_query(mysqli_connect('localhost','root','','shop'),"DELETE FROM products WHERE id='$id';");
		mysqli_query(mysqli_connect('localhost','root','','shop'),"DELETE FROM comments WHERE pid='$id';");
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Товар</title>
	<link rel="stylesheet" href="css/oldstyle.css" />
	<meta charset="utf-8">
	<style>
		input {
			margin-left: auto;
			margin-right: auto;
			text-align: center;
			display:block;}
	</style>
</head>
<body>
	<div class="intro_inner">
	<?php
	echo "<br/>Название: ",mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT name FROM products WHERE id='$id';"))['name'],"<br/>";
	echo "<br/>Производитель: ",mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT mnf FROM products WHERE id='$id';"))['mnf'],"<br/>";
	echo "<br/>Тип: ",mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT styp FROM products WHERE id='$id';"))['styp'],"<br/>";
	echo "<br/>Цена: ",mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT pricetag FROM products WHERE id='$id';"))['pricetag'],"  рублей<br/>";
	echo "<br/>Описание: ",mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT descr FROM products WHERE id='$id';"))['descr'],"<br/>";
	echo '<br/><img src="',substr(mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT link FROM products WHERE id='$id';"))['link'],40),'"></img><br/>';
	echo "<br/>Рейтинг: ",mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT rtng FROM products WHERE id='$id';"))['rtng'],"<br/>";
	?>
	<?php
	if((isset($_SESSION['username']))&(isset($_GET['prid']))){
	?>
		<br/>
		Оцените продукт:
		<br/>
		<form method="post">
			<select name="strs">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			</select>
			<input type="hidden" name="rate" value="1">
			<input type="submit" value="Оценить">
		</form>
		<br/>
		Оставить комментарий:
		<form method="post">
			<textarea name="cmnt"></textarea>
			<input type="hidden" name="docmnt" value="1">
			<input type="submit" value="Оставить">
		</form>
	<?php
	}
	?>
	<?php
	$tofass=mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT nick,text FROM comments WHERE pid='$id' ORDER BY cid;");
	while($cmntarr=mysqli_fetch_assoc($tofass)){
		echo "<br/><b>",$cmntarr['nick'],": </b>";
		echo "<i>",$cmntarr['text'],"</i>";
	}
	?>
	<?php
	$nick=$_SESSION['username'];
	if(mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','register'),"SELECT adm FROM users WHERE username='$nick';"))){
	?>
	<br/>
	<form method="post" enctype="multipart/form-data" > 
		<input type="text" name="stype" value="<?php echo mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT styp FROM products WHERE id='$id';"))['styp'];?>" placeholder="type">
		<input type="text" name="name" value="<?php echo mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT name FROM products WHERE id='$id';"))['name'];?>" placeholder="name">
		<textarea name="descr" placeholder="description"><?php echo mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT descr FROM products WHERE id='$id';"))['descr'];?></textarea>
		<input type="text" name="mnf" value="<?php echo mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT mnf FROM products WHERE id='$id';"))['mnf'];?>" placeholder="manufacturer">
		<input type="text" name="tag" value="<?php echo mysqli_fetch_assoc(mysqli_query(mysqli_connect('localhost','root','','shop'),"SELECT pricetag FROM products WHERE id='$id';"))['pricetag'];?>" placeholder="pricetag">
		Добавить:
		<input type="checkbox" name="dopic">
		<input type="file" name="pic">
		<input type="hidden" name="MAX_FILE_SIZE" value="3000">
		<input type="hidden" name="dochg" value="1">
		<input type="submit">
	</form>
	<form method="post">
		<input type="hidden" name="dodrop" value="1">
		<input type="submit" value="Удалить">
	</form>
	<?php
	}
	?>
</div>
</body>
</html>	
