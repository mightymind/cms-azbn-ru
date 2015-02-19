<?
if($_SESSION['user']['right']['change_entityitem_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="parent"]').val(<?=$param['edit_el']['cat'];?>);
	$('select[name="user"]').val(<?=$param['edit_el']['user'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>

<div class="page-header" >
	<h3><?=$param['entity']['title'];?>. Редактирование записи</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/entityitem/<?=$param['entity']['id'];?>/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<div class="form-group">
				<label for="title" >Заголовок</label>
				<input class="form-control" type="text" name="title" value="<?=$param['edit_el']['title'];?>" />
			</div>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" value="<?=$param['edit_el']['url'];?>" />
			</div>
			
			<div class="form-group">
				<label for="visible" >Видимость</label>
				<select class="form-control" name="visible" >
					<option value="1" >отображать на сайте</option>
					<option value="0" >скрыть запись</option>
				</select>
			</div>
			
			<?
			if($_SESSION['user']['right']['change_entityitem_superuser']) {
				$this->FE->Viewer->form('admin/user_select_html',$param);
				}
			?>
			
			<?
			$this->FE->Viewer->form('admin/entitycat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			
			<?
			if($param['entity']['param']['field']['item']['view_as']) {
			?>
			<div class="form-group">
				<label for="view_as" >Как отображается на сайте</label>
				<input class="form-control" type="text" name="view_as" value="<?=$param['edit_el']['view_as'];?>" />
			</div>
			<?
			}
			?>
			
			
			<?
			if($param['entity']['param']['field']['item']['rating']) {
			?>
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$param['edit_el']['rating'];?>" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['count']) {
			?>
			<div class="form-group">
				<label for="count" >Количество на складе, шт.</label>
				<input type="number" class="form-control" name="count" max="999999999" min="0" value="<?=$param['edit_el']['count'];?>" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['cost']) {
			?>
			<div class="form-group">
				<label for="cost" >Цена</label>
				<input type="number" class="form-control" name="cost" max="999999999" min="0" value="<?=$param['edit_el']['cost'];?>" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['oldcost']) {
			?>
			<div class="form-group">
				<label for="oldcost" >Старая цена</label>
				<input type="number" class="form-control" name="oldcost" max="999999999" min="0" value="<?=$param['edit_el']['oldcost'];?>" />
			</div>
			<?
			}
			?>
			
			
			
			
			<?
			if($param['entity']['param']['field']['item']['img']) {
			?>
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
					'path'=>'entityitem/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['yt_video']) {
			?>
			<div class="form-group">
				<label for="param[yt_video]" >Ссылка на страницу видео на YouTube</label>
				<input class="form-control" type="text" name="param[yt_video]" value="http://www.youtube.com/watch?v=<?=$param['edit_el']['param']['yt_video'];?>" />
			</div>
			<?
			}
			?>
			
			
			<?
			if($param['entity']['param']['field']['item']['preview']) {
			?>
			<div class="form-group">
				<label for="preview" >Краткое содержание</label>
				<textarea class="form-control" name="preview" ><?=$param['edit_el']['preview'];?></textarea>
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['main_info']) {
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>$param['edit_el']['main_info'],
					'upload_path'=>'entityitem/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['coord']) {
			$param['map_form']=array(
				'center'=>array(
					'lat'=>$param['edit_el']['lat'],
					'lng'=>$param['edit_el']['lng'],
					'zoom'=>15,
					),
				'point'=>array(
					'lat'=>$param['edit_el']['lat'],
					'lng'=>$param['edit_el']['lng'],
					'title'=>$param['edit_el']['title'],
					'preview'=>$param['edit_el']['preview'],
					),
				);
			$this->FE->Viewer->form('admin/geopoint_creator_html',$param);
			}
			?>
			
			
			
			<div class="row">
				
				<?
				if($param['entity']['param']['field']['item']['start_at']) {
				?>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="date" >Дата начала</label>
						<input type="text" class="datepicker form-control" name="date" value="<?=date("m/d/Y",$param['edit_el']['start_at']);?>" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время начала (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="<?=date("H:i:s",$param['edit_el']['start_at']);?>" />
					</div>
					
				</div>
				<?
				}
				?>
				
				<?
				if($param['entity']['param']['field']['item']['stop_at']) {
				?>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					
					<div class="form-group">
						<label for="sdate" >Дата окончания</label>
						<input type="text" class="datepicker form-control" name="sdate" value="<?=date("m/d/Y",$param['edit_el']['stop_at']);?>" />
					</div>
					
					<div class="form-group">
						<label for="stime" >Время окончания (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="stime" value="<?=date("H:i:s",$param['edit_el']['stop_at']);?>" />
					</div>
					
					
				</div>
				<?
				}
				?>
				
			</div>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['tag']) {
			?>
			<div class="form-group">
				<label for="tag" >Теги (через точку с запятой!)</label>
				<input class="form-control" type="text" name="tag" value="<?=$param['edit_el']['tag'];?>" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['gal']) {
				$this->FE->Viewer->form('admin/gal_select_html',$param);
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['profile']) {
			?>
			<div class="form-group">
				<label for="tag" >Профиль посетителя</label>
				<input class="form-control" type="text" name="profile" value="<?=$param['edit_el']['profile'];?>" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['filter']) {
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			}
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