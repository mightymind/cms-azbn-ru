<?
if($_SESSION['user']['right']['change_galleryitem_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="visible"]').val(<?=$param['edit_el']['visible'];?>);
	$('select[name="parent"]').val(<?=$param['edit_el']['gal'];?>);
	$('select[name="user"]').val(<?=$param['edit_el']['user'];?>);
	$('select[name="seo"]').val(<?=$param['edit_el']['seo'];?>);
	});
</script>
<div class="page-header" >
	<h3>Обновление изображения</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/galleryitem/<?=$param['edit_el']['id'];?>/" method="POST" >
			
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
			if($_SESSION['user']['right']['change_galleryitem_superuser']) {
				$this->FE->Viewer->form('admin/user_select_html',$param);
				}
			?>
			
			<?
			$this->FE->Viewer->form('admin/gallery_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/rating_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="img" >Изображение</label>
				<?
				$gal=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_gallery']."` WHERE id='{$param['edit_el']['gal']}'");
				if($gal['id']) {
					
				} else {
					$gal=array(
						'w'=>200,
						'h'=>200,
						'crop'=>1,
						);
				}
				$param['img_form']=array(
					'name'=>'img',
					'src'=>$param['edit_el']['img'],
					'w'=>$gal['w'],
					'h'=>$gal['h'],
					'crop'=>$gal['crop'],
					'gray'=>0,
					'path'=>'galleryitem/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/tag_input_html',$param);
			?>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_update_btn', $param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить изображение</button>
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