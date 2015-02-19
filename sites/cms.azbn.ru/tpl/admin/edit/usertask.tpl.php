<?
// ГдеДостать
?>
<div class="page-header" >
	<h3>Изменение задания</h3>
</div>

<div class="row" >

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/usertask/<?=$param['edit_el']['id'];?>" method="POST" >
			
			<script>
			$(document).ready(function(){
				$('select[name="user2"]').val(<?=$param['edit_el']['user2'];?>);
				$('select[name="status"]').val(<?=$param['edit_el']['status'];?>);
				});
			</script>
			
			<div class="form-group">
				<label for="user2" >Кому выставить задание</label>
				<select class="form-control" type="text" name="user2" >
			<?
			$users=$this->FE->DB->dbSelect("SELECT id,view_as FROM `{$this->FE->DB->dbtables['t_user']}` ORDER BY rating,id");
			if(mysql_num_rows($users)) {
				while($row=mysql_fetch_array($users)) {
			?>
					<option value="<?=$row['id'];?>" ><?=$row['view_as'];?></option>
			<?
			}
				}
			?>
				</select>
			</div>
			
			<div class="form-group">
				<label for="title" >Название задания</label>
				<input class="form-control" type="text" name="title" value="<?=$param['edit_el']['title'];?>" />
			</div>
			
			<div class="form-group">
				<label for="status" >Статус задания</label>
				<select class="form-control" type="text" name="status" >
					<option value="0" >не выполнено</option>
					<option value="1" >не может быть выполнено</option>
					<option value="2" >выполняется</option>
					<option value="3" >выполнено</option>
				</select>
			</div>
			
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$param['edit_el']['rating'];?>" />
			</div>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>$param['edit_el']['main_info'],
					'upload_path'=>'usertask/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
						
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Обновить" />
			</div>
			
		</form>
		
		<?
		$this->FE->Viewer->form('admin/backup_list_html',$param);
		?>
				
		<div class="clear">&nbsp;</div>
	</div>
				
	<div class="clear">&nbsp;</div>
</div>