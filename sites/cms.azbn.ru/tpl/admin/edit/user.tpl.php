<?
// ГдеДостать
$rights=array();
$_rights=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_userright']."` ORDER BY id");
while($row=mysql_fetch_array($_rights)) {
	$rights[$row['right_id']]=$row['right_name'];
	}
unset($_rights);

?>
<script>
$(document).ready(function(){
	$('select[name="default_editor"]').val('<?=$param['edit_el']['param']['default_editor'];?>');
	});
</script>
<div class="page-header" >
	<h3>Редактирование администратора</h3>
</div>
	
	<form action="/admin/update/user/<?=$param['edit_el']['id'];?>" method="POST" >
	
	<div class="row" >
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				
			<?
			$this->FE->Viewer->form('admin/is_backup_check_html',$param);
			?>
			
				<div class="form-group">
					<label for="login" >Логин</label>
					<input type="text" class="form-control" name="login" value="<?=$param['edit_el']['login'];?>" />
				</div>
				
				<div class="form-group">
					<label for="img" >Изображение</label>
				<?
				$param['img_form']=array(
					'name'=>'img',
					'src'=>$param['edit_el']['img'],
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
					<input type="text" class="form-control" name="view_as" value="<?=$param['edit_el']['view_as'];?>" />
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
					<input type="text" class="form-control" name="url" placeholder="Например: http://azbn.ru/" value="<?=$param['edit_el']['param']['url'];?>" />
				</div>
				
				<div class="form-group">
					<label for="vk_url" >Ссылка на профиль ВК</label>
					<input type="text" class="form-control" name="vk_url" placeholder="Например: http://vk.com/azbn_ru" value="<?=$param['edit_el']['param']['vk']['url'];?>" />
				</div>
				
				<div class="form-group">
					<label for="twitter_url" >Ссылка на профиль Twitter</label>
					<input type="text" class="form-control" name="twitter_url" placeholder="Например: http://twitter.com/azbn_ru" value="<?=$param['edit_el']['param']['twitter']['url'];?>" />
				</div>
				
				<div class="form-group">
					<label for="email" >E-mail</label>
					<input type="text" class="form-control" name="email" placeholder="Например: your@email.com" value="<?=$param['edit_el']['param']['email'];?>" />
				</div>
				
				<div class="form-group">
					<label for="adr" >Адрес</label>
					<input type="text" class="form-control" name="adr" placeholder="Например: Орел, ул.Вашего Адреса, д.1" value="<?=$param['edit_el']['param']['adr'];?>" />
				</div>
				
				<div class="form-group">
					<label for="phone" >Телефон</label>
					<input type="text" class="form-control" name="phone" placeholder="Например: 79876543210" value="<?=$param['edit_el']['param']['phone'];?>" />
				</div>
				
				<div class="form-group">
					<label for="timezone" >Временная зона</label>
					<input type="text" class="form-control" name="timezone" placeholder="Например: Europe/Moscow" value="<?=$param['edit_el']['param']['timezone'];?>" />
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
			<td ><input type="checkbox" name="right[<?=$r_k;?>]" value="1" <? if($param['edit_el']['right'][$r_k]){ echo 'checked';}?> /></td>
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
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Сохранить" />
				</div>
		
		<?
		$this->FE->Viewer->form('admin/backup_list_html',$param);
		?>
		
			<div class="clear">&nbsp;</div>
		</div>
		
		<div class="clear">&nbsp;</div>
	</div>
	
	</form>