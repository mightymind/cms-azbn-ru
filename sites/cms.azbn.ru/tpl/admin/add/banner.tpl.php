<?
if($_SESSION['user']['right']['change_banner']) {
?>
<script>
$(document).ready(function(){
	
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
	<h3>Создание баннера</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/banner/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/bannercat_select_html_4banner',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/url_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/rating_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="rating" >Изображение баннера</label>
				<input type="hidden" name="img" id="banner-img-value" />
				
				<div id="banner-img-field" >
					
				</div>
				
				<div class="clear10">&nbsp;</div>
				
				<div id="banner-img-result" >
					
				</div>
				
				<div class="clear10">&nbsp;</div>
				
			</div>
			
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Создать баннер</button>
			</div>
			
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>