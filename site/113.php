<!DOCTYPE HTML>
<html>
<head>
	<title>11sem3</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	if(mysqli_num_rows(mysqli_query(mysqli_connect('','grigorev','fuckenfucken_grig','grigorev'),"SELECT * FROM products;"))>0){
		?>
			<form>
				<b>filter</b><br/>
				manufacturer:
				<select name="fmnf">
					<option value="">any</option>
					<?php
					$dbc=mysqli_connect('','grigorev','fuckenfucken_grig','grigorev');
					$tofass=mysqli_query($dbc,"SELECT mnf FROM products;");
					while($mnfarr=mysqli_fetch_assoc($tofass)){
						echo "<option value=\"",$mnfarr['mnf'],"\">",$mnfarr['mnf'],"</option>";
					}
					?>
				</select>
				<br/>
				type:
				<select name="ftyp">
					<option value="">any</option>
					<?php
					$tofass1=mysqli_query($dbc,"SELECT styp FROM products;");
					while($styparr=mysqli_fetch_assoc($tofass1)){
						echo "<option value=\"",$styparr['styp'],"\">",$styparr['styp'],"</option>";
					}
					?>
				</select>
				<br/>
				<b>sort</b>
				<br/>
				by:
				<select name="sby">
					<option value="">default</option>
					<option value="pricetag">price</option>
					<option value="rtng">rating</option>
				</select>
				<br/>
				in order:
				<select name="sdir">
					<option value="asc">ascending</option>
					<option value="desc">descending</option>
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
			<th>type</th>
			<th>name</th>
			<th>manufacturer</th>
			<th>price</th>
			<th>rating</th>
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
			$q="SELECT id,styp,name,mnf,pricetag,rtng FROM products".$where.$wmnf.$and.$wstyp.$orderby.$desc;
			$arow=mysqli_num_rows(mysqli_query($dbc,$q));
			if(isset($_GET['pg'])){
				$pg=($_GET['pg']-1)*20;
			} else {
				$pg=0;
			}
			$q=$q." LIMIT ".$pg.",20";
			$tofass2=mysqli_query($dbc,$q);
			while($prarr=mysqli_fetch_assoc($tofass2)){
				echo "<tr><td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['styp'],"</a></td><td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['name'],"</a></td><td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['mnf'],"</a></td><td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['pricetag'],"</a></td><td><a href=\"112.php?prid=",$prarr['id'],"\">",$prarr['rtng'],"</a></td></tr>";
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
