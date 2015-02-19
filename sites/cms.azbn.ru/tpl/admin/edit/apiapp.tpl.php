<?
// ГдеДостать
?>
<div class="page-header" >
	<h3>Обновление приложения API</h3>
</div>

					<div class="row" >
					
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
							
							<form action="/admin/update/apiapp/<?=$param['edit_el']['id'];?>" method="POST" >
								<div class="form-group">
									<label for="login" >Логин приложения</label>
									<input type="text" class="form-control" name="login" value="<?=$param['edit_el']['login'];?>" />
								</div>
								
								<div class="form-group">
									<label for="status" >Статус</label>
									<select class="form-control" name="status" >
										<option value="1" >Есть доступ</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="rating" >Рейтинг</label>
									<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$param['edit_el']['rating'];?>" />
								</div>
								
								<div class="form-group">
									<label for="pass" >Пароль (будет зашифрован)</label>
									<input type="text" class="form-control" name="pass" />
								</div>
								
								<div class="form-group">
									<label for="app_key" >Ключ доступа</label>
									<input type="text" class="form-control" name="app_key" value="<?=$param['edit_el']['app_key'];?>" />
								</div>
								
								<div class="form-group">
									<input type="submit" class="btn btn-primary" value="Сохранить" />
								</div>
							</form>
							
			<?
		$this->FE->Viewer->form('admin/backup_list_html',$param);
		?>
						
							<div class="clear">&nbsp;</div>
						</div>
						
						<div class="clear">&nbsp;</div>
					</div>