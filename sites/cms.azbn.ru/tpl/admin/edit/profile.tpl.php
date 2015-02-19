<?
if($_SESSION['user']['right']['change_profile_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="status"]').val(<?=$param['edit_el']['status'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>
<div class="page-header" >
	<h3>Редактирование пользователя</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/profile/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<div class="form-group">
				<label for="view_as" >Как отображается на сайте</label>
				<input class="form-control" type="text" name="view_as" value="<?=$param['edit_el']['view_as'];?>" />
			</div>
			
			<div class="form-group">
				<label for="login" >Логин</label>
				<input class="form-control" type="text" name="login" value="<?=$param['edit_el']['login'];?>" />
			</div>
			
			<div class="form-group">
				<label for="status" >Статус</label>
				<select class="form-control" name="status" >
					<option value="1" >действующий профиль</option>
					<option value="0" >заблокирован</option>
				</select>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$param['edit_el']['rating'];?>" />
			</div>
			
			<div class="form-group">
				<label for="cash" >Сумма на счете</label>
				<input type="number" class="form-control" name="cash" max="999999999" min="0" value="<?=$param['edit_el']['cash'];?>" />
			</div>
			
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
					'path'=>'profile/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить запись</button>
			</div>
		
		</form>
		
		<?
		$this->FE->Viewer->form('admin/backup_list_html',$param);
		?>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>