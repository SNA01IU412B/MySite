<?php
 include("auth.php");
 if ($_SESSION['adm'] == 1) {
  $id_comment = $_POST["id_comment"];
  $mysqli = new mysqli("localhost", "root", "", "comment");
  $mysqli->query("DELETE FROM `comment_table` WHERE `comment_table`.`id` = $id_comment");
  header("Location: ".$_SERVER["HTTP_REFERER"]);
 }
 else {
 	echo "Permission denied";
 }
?>