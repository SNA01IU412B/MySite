<?php
 require('db.php');
	require("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	$one = $_SESSION["username"];
	$two = $_SESSION["adm"];
	echo "$one";
	echo "$two";
	if(isSet($_SESSION['username'])){
		$two = $_SESSION["adm"];
		if($two!=1){
			echo "Denied";
			exit(4);
		} else {
			echo "Success";
		}
	}
	?>
</body>
</html>
	