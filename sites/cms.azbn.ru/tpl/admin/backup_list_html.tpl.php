<?
if($_SESSION['user']['right']['view_backuplist']) {
// загрузка списка бекапов элемента
$type=$this->FE->c_s($param['req_arr']['param_1']);
$entity_id=$this->FE->as_int($param['entity']['id']);

$backup_list=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_backup']."` WHERE el_id='{$param['edit_el']['id']}' AND entity='$entity_id' AND el_type='{$type}' ORDER BY id DESC");

if(mysql_num_rows($backup_list)) {
	?>
		<div class="clear30">&nbsp;</div>
		
		<hr />
		
		<h3>Предыдущие сохраненные версии</h3>
		<table class="table table-bordered table-condensed" >
			<tbody>
				<tr class="info">
					<td width="40%">Дата, время</td>
					<td width="30%">Администратор</td>
					<td width="30%">Запись</td>
				</tr>
	<?
	while($row=mysql_fetch_array($backup_list)) {
		
		$row['user_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='".$row['user']."'");
				?>
					<tr class="" >
						<td><?=date("Y/m/d H:i:s",$row['created_at']);?></td>
						<td><?=$row['user_id']['view_as'];?></td>
						<td><a href="/admin/backup/<?=$row['el_type'];?>/<?=$row['id'];?>/" ><img src="/img/cms.azbn.ru/backup.png" class="icon" /> загрузить для редактирования</a></td>
					</tr>
				<?
	}
	?>
			</tbody>
		</table>
	<?
	}
}
?>