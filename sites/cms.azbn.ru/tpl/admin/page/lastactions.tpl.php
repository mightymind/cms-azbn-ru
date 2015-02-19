<?
// ГдеДостать
$user_id=$this->FE->as_int($_GET['user']);
$act_count=isset($_GET['count'])?$this->FE->as_int($_GET['count']):75;
$act_type=isset($_GET['type'])?"type='".$this->FE->c_s($_GET['type'])."'":'1';

$user=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='$user_id'");
$actions=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_log']."` WHERE user='$user_id' AND $act_type ORDER BY id DESC LIMIT $act_count");

?>
<div class="page-header" >
	<h3>
		Последние действия пользователя <?=$user['view_as'];?>
	</h3>
</div>

	<div class="row" >
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			
			<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
					Типы действий
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" href="/admin/page/lastactions/?user=<?=$user['id'];?>">Все типы действий</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/page/lastactions/?user=<?=$user['id'];?>&type=login">Входы</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/page/lastactions/?user=<?=$user['id'];?>&type=create">Добавления</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/page/lastactions/?user=<?=$user['id'];?>&type=update">Обновления</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/page/lastactions/?user=<?=$user['id'];?>&type=delete">Удаления</a></li>
					<li role="presentation"><a role="menuitem" href="/admin/page/lastactions/?user=<?=$user['id'];?>&type=clear">Очистки таблиц</a></li>
				</ul>
			</div>
			
			<hr />
			
			<div class="clear">&nbsp;</div>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
<?
// ГдеДостать
if(mysql_num_rows($actions)) {

?>
	<table class="table table-striped table-bordered table-hover table-condensed" >
		<tbody>
	<?
	while($row=mysql_fetch_array($actions)) {
		?>
			<tr>
				<td>
					<?=date("Y/m/d H:i:s",$row['created_at']);?>
				</td>
				<td>
					<?=$row['el_id'];?>
				</td>
				<td>
					<?=$row['el_type'];?>
				</td>
				<td>
					<?=$row['type'];?>
				</td>
			</tr>
		<?
		}
	?>
		</tbody>
	</table>
	<?
	}
	?>
						
			<div class="clear">&nbsp;</div>
		</div>
	
		<div class="clear">&nbsp;</div>
	</div>