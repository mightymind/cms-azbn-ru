<?
// ГдеДостать
$rights=array();
$_rights=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_userright']."` ORDER BY id");
while($row=mysql_fetch_array($_rights)) {
	$rights[$row['right_id']]=$row['right_name'];
	}
unset($_rights);

?>
<div class="page-header" >
	<h3>Добавление администратора</h3>
</div>
	
	<form action="/admin/create/user/" method="POST" >
	
	<div class="row" >
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				
				<div class="form-group">
					<label for="login" >Логин</label>
					<input type="text" class="form-control" name="login" value="" />
				</div>
				
				<div class="form-group">
					<label for="img" >Изображение</label>
				<?
				$param['img_form']=array(
					'name'=>'img',
					'src'=>'/img/cms.azbn.ru/default.png',
					'w'=>170,
					'h'=>170,
					'crop'=>1,
					'gray'=>0,
					'path'=>'user/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
				</div>
				
				<div class="form-group">
					<label for="view_as" >Отображать как</label>
					<input type="text" class="form-control" name="view_as" value="" />
				</div>
				
				<div class="form-group">
					<label for="pass" >Пароль</label>
					<input type="text" class="form-control" name="pass" value="" />
				</div>
				
				<?
				$this->FE->Viewer->form('admin/default_editor_select_html',$param);
				?>
				
				<div class="form-group">
					<label for="url" >URL</label>
					<input type="text" class="form-control" name="url" placeholder="Например: http://azbn.ru/" />
				</div>
				
				<div class="form-group">
					<label for="vk_url" >Ссылка на профиль ВК</label>
					<input type="text" class="form-control" name="vk_url" placeholder="Например: http://vk.com/azbn_ru" />
				</div>
				
				<div class="form-group">
					<label for="twitter_url" >Ссылка на профиль Twitter</label>
					<input type="text" class="form-control" name="twitter_url" placeholder="Например: http://twitter.com/azbn_ru" />
				</div>
				
				<div class="form-group">
					<label for="email" >E-mail</label>
					<input type="text" class="form-control" name="email" placeholder="Например: your@email.com" />
				</div>
				
				<div class="form-group">
					<label for="adr" >Адрес</label>
					<input type="text" class="form-control" name="adr" placeholder="Например: Орел, ул.Вашего Адреса, д.1" />
				</div>
				
				<div class="form-group">
					<label for="phone" >Телефон</label>
					<input type="text" class="form-control" name="phone" placeholder="Например: 79876543210" />
				</div>
				
				<div class="form-group">
					<label for="timezone" >Временная зона</label>
					<input type="text" class="form-control" name="timezone" placeholder="Например: Europe/Moscow" value="Europe/Moscow" />
				</div>
				
				<?
				if(count($rights)) {
				?>
				<div class="pull-right" >
					<a class="btn btn-xs userright-btn-select" href="#select-all" >Выбрать все</a>
					/
					<a class="btn btn-xs userright-btn-unselect" href="#unselect-all" >Убрать все</a>
				</div>
				
				<table class="table table-striped table-bordered table-hover table-condensed userright-as-table" >
					<tbody>
		<?
		foreach($rights as $r_k=>$r_v) {
		?>
		<tr >
			<td ><input type="checkbox" name="right[<?=$r_k;?>]" value="1" /></td>
			<td ><?=$r_v;?></td>
		</tr>
		<?
			}
		?>
					</tbody>
				</table>
				<?
					}
				?>
				
				<?
				$this->FE->PluginMng->event('admin:viewer:before_create_btn', $param);
				?>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Сохранить" />
				</div>
		
			<div class="clear">&nbsp;</div>
		</div>
		
		<div class="clear">&nbsp;</div>
	</div>
	
	</form>