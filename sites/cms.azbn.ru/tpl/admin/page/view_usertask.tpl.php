<?
// ГдеДостать
$usertask_id=$this->FE->as_int($param['req_arr']['param_2']);
$usertask=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_usertask']."` WHERE id='$usertask_id'");
$usertask['param']=unserialize($usertask['param']);

$user=$this->FE->DB->dbSelectFirstRow("SELECT id,view_as FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='{$usertask['user']}'");
$user2=$this->FE->DB->dbSelectFirstRow("SELECT id,view_as FROM `".$this->FE->DB->dbtables['t_user']."` WHERE id='{$usertask['user2']}'");

?>

<div class="page-header" >
	<h3>Просмотр задания <u><?=$usertask['title'];?></u></h3>
</div>

	<div class="row" >
	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			
			<div class="pull-right well well-sm" >
				<p>Создано <?=date("Y/m/d H:i:s", $usertask['created_at']);?></p>
				<p>Задание от: <b><?=$user['view_as'];?></b></p>
				<p>Задание для: <b><?=$user2['view_as'];?></b></p>
				
				<?
				if($_SESSION['user']['id']==$usertask['user2']) {
				?>
					<script>
					$(document).ready(function(){
						$('select[name="status"]').val(<?=$usertask['status'];?>);
						});
					</script>
					
					<hr />
					
						<div class="form-group">
							<label for="status" >Статус задания</label>
							<select class="form-control" type="text" name="status" id="status_id" >
								<option value="0" >не выполнено</option>
								<option value="1" >не может быть выполнено</option>
								<option value="2" >выполняется</option>
								<option value="3" >выполнено</option>
							</select>
						</div>
						
						<div class="form-group">
							<a href="#change_status" class="btn btn-success" onClick="AdminAPI.call({service:'usertask', method:'change_status', id:'<?=$usertask['id'];?>', status:$('#status_id').val(), callback:'UserTaskChangeStatus'});" >Изменить статус</a>
						</div>
				
				<?
					}
				?>
				
			</div>
			
			<?=$usertask['main_info'];?>
			
			<div class="clear">&nbsp;</div>
		</div>
		
		<div class="clear">&nbsp;</div>
	</div>