<?
if($_SESSION['user']['right']['change_banner']) {
?>
<script>
$(document).ready(function(){
	
	$('select[name="view_at"]').val(<?=$param['edit_el']['view_at'];?>);
	
	$('#banner-img-field').jqfeDropUploader({
		action:'/admin/upload/file/?path=banner/img',
		name:'uploading_file',
		callback:function(file,response,counter){
			
			$('#banner-img-value').val(response);
			$('#banner-img-result').children('img').empty().remove();
			$('#banner-img-result').append('<img src="'+response+'" />');
			
			}
		});
	
	});
</script>
<div class="page-header" >
	<h3>Обновление баннера</h3>
</div>

<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		
		<?
		$this->FE->Viewer->form('admin/is_backup_check_html',$param);
		?>
		
		<form action="/admin/update/banner/<?=$param['edit_el']['id'];?>/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/bannercat_select_html_4banner',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="url" >Ссылка, куда ведет баннер</label>
				<input class="form-control" type="text" name="url" value="<?=$param['edit_el']['url'];?>" />
			</div>
			
			<?
			$this->FE->Viewer->form('admin/rating_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="rating" >Изображение баннера</label>
				<input type="hidden" name="img" id="banner-img-value" value="<?=$param['edit_el']['img'];?>" />
				
				<div id="banner-img-field" >
					
				</div>
				
				<div class="clear10">&nbsp;</div>
				
				<div id="banner-img-result" >
					<img src="<?=$param['edit_el']['img'];?>" />
				</div>
				
				<div class="clear10">&nbsp;</div>
				
			</div>
			
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Обновить баннер</button>
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