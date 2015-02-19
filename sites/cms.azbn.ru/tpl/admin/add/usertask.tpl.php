<div class="page-header" >
	<h3>Создание задания</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/usertask/" method="POST" >
			
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
				<label for="title" >Заголовок</label>
				<input class="form-control" type="text" name="title" />
			</div>
			
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="999999999" />
			</div>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
					'upload_path'=>'usertask/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Создать задание</button>
			</div>
			
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>