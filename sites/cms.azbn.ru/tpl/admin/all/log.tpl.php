<?
if($_SESSION['user']['right']['view_log']) {
?>
<div class="page-header" >
	<h3>
		Последние действия в административном разделе
	</h3>
</div>

					<div class="row" >
					
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
<?
// ГдеДостать
if(mysql_num_rows($param['el_list'])) {

?>
	<table class="table table-bordered table-condensed" >
		<tbody>
			<tr class="info">
				<td width="30%">Дата, время</td>
				<td width="20%">Администратор</td>
				<td width="30%">Запись</td>
				<td width="20%">Действие</td>
			</tr>
	<?
	while($row=mysql_fetch_array($param['el_list'])) {
		
		$row['user_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='".$row['user']."'");
		$row['item_id']=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_'.$row['el_type']]."` WHERE id='".$row['el_id']."'");
		
		if($row['item_id']['id'] || $row['type']=='delete' || $row['type']=='fulltext_delete') {
			
			switch($row['el_type']) {
				case 'user':
				case 'profile':{
					$row['title']=$row['item_id']['view_as'];
				}
				break;
				
				case 'alias':{
					$row['title']=$row['item_id']['req'];
				}
				break;
				
				/*
				case 'uplfile':
				case 'entity':
				case 'usertask':
				case 'banner':{
					$row['title']=$row['item_id']['name'];
				}
				break;
				*/
				
				case 'userright':{
					$row['title']=$row['item_id']['right_name'];
				}
				break;
				
				case 'apiapp':{
					$row['title']=$row['item_id']['login'];
				}
				break;
				
				case 'feedback':{
					$row['title']=$row['item_id']['view_as'].', '.$row['item_id']['email'];
				}
				break;
				
				case 'faq':{
					$row['title']=$row['item_id']['main_info'];
				}
				break;
				
				default:{
					$row['title']=$row['item_id']['title'];
				}
				break;
			}
			
			if(mb_strlen($row['title'],$this->FE->config['charset'])) {
				
			} else {
				$row['title']='<s>Название не определено</s>';
			}
			
			?>
				<tr class="" >
					<td><?=date("Y/m/d H:i:s",$row['created_at']);?></td>
					<td><?=$row['user_id']['view_as'];?></td>
					<td><a href="/admin/edit/<?=$row['el_type'];?>/<?=$row['el_id'];?>/" ><?=$row['title'];?></a></td>
					<td><?=$row['type'];?></td>
				</tr>
			<?
			}
			
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
<?
	}
?>