<?
// вывод списка невыполненных заданий
$usertask4working=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_usertask']."` WHERE status IN (0,2) AND user2='".$_SESSION['user']['id']."' ORDER BY id LIMIT 7");
if(mysql_num_rows($usertask4working)) {
	?>
	<div class="clear30" ></div>
	<div class="well well-sm" >
		<div class="clear20" ></div>
		<h4>Невыполненные задания</h4>
		<div class="clear20" ></div>
	<?
	while($row=mysql_fetch_array($usertask4working)) {
		if($row['status']) {
			?>
			<div class="alert alert-warning" ><a href="/admin/page/view_usertask/<?=$row['id'];?>" ><?=$row['title'];?></a></div>
			<?
			} else {
				?>
				<div class="alert alert-danger" ><a href="/admin/page/view_usertask/<?=$row['id'];?>" ><?=$row['title'];?></a></div>
				<?
				}
		}
	mysql_data_seek($usertask4working,0);
	?>
	</div>
	<?
	}
?>