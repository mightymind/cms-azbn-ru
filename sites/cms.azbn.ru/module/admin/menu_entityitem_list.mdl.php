<?
// вывод списка невыполненных заданий
$entities=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` WHERE 1 ORDER BY id");
if(mysql_num_rows($entities)) {
	?>
	
	<li class="divider" ></li>
	
	<?
	while($row=mysql_fetch_array($entities)) {
	?>
	<li><a href="/admin/all/entityitem/<?=$row['id'];?>/" ><?=$row['title'];?></a></li>
	<?
	}
	mysql_data_seek($entities,0);
	}
?>