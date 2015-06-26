<?
// стандартная баннеропоказка
if(mysql_num_rows($param['banner_list'])) {
	while($row=mysql_fetch_array($param['banner_list'])) {
		?>
		<a href="/banner/item/<?=$row['id'];?>/" target="_blank" ><img src="<?=$row['img'];?>" title="<?=$row['title'];?>" /></a>
		<?
		}
	}
?>