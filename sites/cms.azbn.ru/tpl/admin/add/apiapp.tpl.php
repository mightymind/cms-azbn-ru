<?
// ГдеДостать
?>
<div class="page-header" >
	<h3>Создание приложения API</h3>
</div>

					<div class="row" >
					
						<div class="col-sm-12 col-lg-12" >
							
							<form action="/admin/create/apiapp/" method="POST" >
								<div class="form-group">
									<label for="login" >Логин приложения</label>
									<input type="text" class="form-control" name="login" />
								</div>
								
								<div class="form-group">
									<label for="status" >Статус</label>
									<select class="form-control" name="status" >
										<option value="1" >Есть доступ</option>
									</select>
								</div>
								
								<?
								$this->FE->Viewer->form('admin/rating_input_html',$param);
								?>
								
								<div class="form-group">
									<label for="pass" >Пароль (будет зашифрован)</label>
									<input type="text" class="form-control" name="pass" />
								</div>
								
								<div class="form-group">
									<label for="app_key" >Ключ доступа</label>
									<input type="text" class="form-control" name="app_key" value="" />
								</div>
								
								<?
								$this->FE->PluginMng->event('admin:viewer:before_create_btn', $param);
								?>
								
								<div class="form-group">
									<input type="submit" class="btn btn-primary" value="Сохранить" />
								</div>
							</form>
						
							<div class="clear">&nbsp;</div>
						</div>
						
						<div class="clear">&nbsp;</div>
					</div>