<?
if($_SESSION['user']['right']['change_entityitem_add']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3><?=$param['entity']['title'];?>. Создание записи</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/entityitem/<?=$param['entity']['id'];?>/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/url_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/visible_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/entitycat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<?
			if($param['entity']['param']['field']['item']['uid']) {
			?>
			<div class="form-group">
				<label for="view_as" >Уникальный UID</label>
				<input class="form-control" type="text" name="uid" value="" />
			</div>
			<?
			}
			?>
			
			<?
			if($param['entity']['param']['field']['item']['view_as']) {
			?>
			<div class="form-group">
				<label for="view_as" >Как отображается на сайте</label>
				<input class="form-control" type="text" name="view_as" value="" />
			</div>
			<?
			}
			?>
			
			
			<?
			if($param['entity']['param']['field']['item']['rating']) {
				$this->FE->Viewer->form('admin/rating_input_html',$param);
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['count']) {
			?>
			<div class="form-group">
				<label for="count" >Количество на складе, шт.</label>
				<input type="number" class="form-control" name="count" max="999999999" min="0" value="0" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['cost']) {
			?>
			<div class="form-group">
				<label for="cost" >Цена</label>
				<input type="number" class="form-control" name="cost" max="999999999" min="0" value="0" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['oldcost']) {
			?>
			<div class="form-group">
				<label for="oldcost" >Старая цена</label>
				<input type="number" class="form-control" name="oldcost" max="999999999" min="0" value="0" />
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
					'src'=>'/img/cms.azbn.ru/default.png',
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
				$this->FE->Viewer->form('admin/yt_video_input_html',$param);
			}
			?>
			
			
			<?
			if($param['entity']['param']['field']['item']['preview']) {
				$this->FE->Viewer->form('admin/preview_textarea_html',$param);
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['main_info']) {
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
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
					'lat'=>52.965679,
					'lng'=>36.079818,
					'zoom'=>15,
					),
				'point'=>array(
					'lat'=>52.965679,
					'lng'=>36.079818,
					'title'=>'Метка',
					'preview'=>'Подробно о метке',
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
						<input type="text" class="datepicker form-control" name="date" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время начала (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="00:00:00" />
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
						<input type="text" class="datepicker form-control" name="sdate" />
					</div>
					
					<div class="form-group">
						<label for="stime" >Время окончания (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="stime" value="00:00:00" />
					</div>
					
					
				</div>
				<?
				}
				?>
				
			</div>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['tag']) {
				$this->FE->Viewer->form('admin/tag_input_html',$param);
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
				<input class="form-control" type="text" name="profile" value="0" />
			</div>
			<?
			}
			?>
			
			
			
			<?
			if($param['entity']['param']['field']['item']['filter']) {
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			}
			?>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_create_btn', $param);
			?>
			
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Создать запись</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>