<!DOCTYPE HTML>
<html>
<head>
	<title>Товары</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	if(mysqli_num_rows(mysqli_query(mysqli_connect('localhost','root','','shop'),
		"SELECT * FROM products;"))>0){
		?>
			<form>
				<b>Показывать только:</b><br/>
				Производитель:
				<select name="fmnf">
					<option value="">Любой</option>
					<?php
					$dbc=mysqli_connect('localhost','root','','shop');
					$tofass=mysqli_query($dbc,"SELECT mnf FROM products;");
					while($mnfarr=mysqli_fetch_assoc($tofass)){
						echo "<option value=\"",$mnfarr['mnf'],"\">",$mnfarr['mnf'],"</option>";
					}
					?>
				</select>
				<br/>
				Тип:
				<select name="ftyp">
					<option value="">Любой</option>
					<?php
					$tofass1=mysqli_query($dbc,"SELECT styp FROM products;");
					while($styparr=mysqli_fetch_assoc($tofass1)){
						echo "<option value=\"",$styparr['styp'],"\">",$styparr['styp'],"</option>";
					}
					?>
				</select>
				<br/>
				<b>Сортировать</b>
				<br/>
				По:
				<select name="sby">
					<option value="">-</option>
					<option value="pricetag">Цене</option>
					<option value="rtng">Рейтингу</option>
				</select>
				<br/>
				В порядке:
				<select name="sdir">
					<option value="asc">Возрастания</option>
					<option value="desc">Убывания</option>
				</select>
				<input type="hidden" name="sent" value="1">
				<input type="submit" value="go">
			</form>
			<br/>
		<?php
		}
	?>
	<table border="5">
		<tr>
			<th>Тип</th>
			<th>Название</th>
			<th>Производитель</th>
			<th>Цена</th>
			<th>Рейтинг</th>
		</tr>
		<?php
			if($_GET['sent']){
				if(!empty($_GET['fmnf'])){
					$where=" WHERE";
					$wmnf=" mnf='".$_GET['fmnf']."'";
				}
				if(!empty($_GET['ftyp'])){
					$where=" WHERE";
					$wstyp=" styp='".$_GET['ftyp']."'";
				}
				if(isset($wstyp)&(isset($wmnf))){
					$and=" AND";
				}
				if(!empty($_GET['sby'])){
					$orderby=" ORDER BY ".$_GET['sby'];
					if($_GET['sdir']=="desc"){
						$desc=" DESC";
					}
				}
			}
			$q="SELECT id,styp,name,mnf,pricetag,rtng FROM products";
			//.$where.$wmnf.$and.$wstyp.$orderby.$desc;
			$arow=mysqli_num_rows(mysqli_query($dbc,$q));
			if(isset($_GET['pg'])){
				$pg=($_GET['pg']-1)*20;
			} else {
				$pg=0;
			}
			$q=$q." LIMIT ".$pg.",20";
			$tofass2=mysqli_query($dbc,$q);
			while($prarr=mysqli_fetch_assoc($tofass2)){
				echo "<tr>
				<td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['styp'],"</a></td>
				<td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['name'],"</a></td>
				<td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['mnf'],"</a></td>
				<td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['pricetag'],"</a></td>
				<td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['rtng'],"</a></td>
				</tr>";
			}
		?>
	</table>
	<?php
	for($pgn=1;$pgn<=(intdiv($arow,20)+1);$pgn++){
		echo "<a href=\"?pg=",$pgn,"&fmnf=",$_GET['fmnf'],"&ftyp=",$_GET['ftyp'],"&sby=",$_GET['sby'],"&sdir=",$_GET['sdir'],"&sent=",$_GET['sent'],"\">[",$pgn,"]</a>";
	}
	?>	
</body>
</html>	
