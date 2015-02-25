<?
$uniq=$this->FE->randstr(12);
$img=$param['img_param'];
?>
<!-- Массовый загрузчик -->

<script>

$(document).ready(function() {
	
	$('.gi-uploader-btn-<?=$uniq;?>').on('click',function(){
		$('#gi-uploader-someimguploader-<?=$uniq;?>-imgs-list').children('img').remove();
		$('#gi-uploader-someimguploader-<?=$uniq;?>').jqfeModal();
		});
	
	$('#gi-uploader-someimguploader-<?=$uniq;?>-imgs').jqfeDropImgOptimizer2({
		max_width:<?=$img['w']?>,
		max_height:<?=$img['h']?>,
		callback:function(dataURL){
			
			$.post('/admin/upload/dataurl/',{'path':'<?=$img['path']?>','img_to_save':dataURL},function(data){
				
				AdminAPI.callbacks.MassUploadGalleryItem_<?=$uniq;?>=function(resp) {
					
					var edit_right=false;
					var delete_right=false;
					<?
					if($_SESSION['user']['right']['change_galleryitem_edit']) {
					?>
					edit_right=true;
					<?
						}
					?>
					<?
					if($_SESSION['user']['right']['change_galleryitem_delete']) {
					?>
					delete_right=true;
					<?
						}
					?>
					
					if(resp.response.result.item) {
						$('<img/>',{
							src:resp.response.item.img,
							class:'main_info_preview',
							}).appendTo($('#gi-uploader-someimguploader-<?=$uniq;?>-imgs-list'));
						
						var gi_html='<td><a href="'+resp.response.item.img+'" target="_blank" ><img src="'+resp.response.item.img+'" /></a></td><td><p></p></td><td>';
						if(edit_right) {
							gi_html=gi_html+'<a href="/admin/edit/galleryitem/'+resp.response.item.id+'/" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>';
						}
						if(delete_right) {
							gi_html=gi_html+'<a class="confirm-delete" href="/admin/delete/galleryitem/'+resp.response.item.id+'/" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>';
						}
						gi_html=gi_html+'</td>';
						
						$('<tr/>',{
							class:'visible1',
							html:gi_html
						}).insertAfter($('tr#table-of-galleryitem-header'));
					}
					
					};
				AdminAPI.call({
					service:'create',
					method:'galleryitem',
					gal:<?=$img['gal']?>,
					seo:<?=$img['seo']?>,
					img:data,
					callback:'MassUploadGalleryItem_<?=$uniq;?>'
					});
				
				});
			
			}
		});
	
	});
	
</script>

<?
if($_SESSION['user']['right']['upload_imgs']) {
?>
<a href="#gi-upload-someimg" class="btn btn-sm btn-primary gi-uploader-btn-<?=$uniq;?>" >Загрузить несколько изображений</a>
<?
}
?>
	<div class="row" >
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:none;" >
			<div id="gi-uploader-someimguploader-<?=$uniq;?>" >
				
				<h3>Поле ниже служит для загрузки изображений на сервер</h3>
				<p>Загрузка фотографий данным способом не позволяет привести их к одному размеру и соотношению сторон.</p>
				<p>Настройки галереи, куда они загружаются, позволяют задать только максимальные значения высоты и ширины.</p>
				<div class="clear20" ></div>
				<div id="gi-uploader-someimguploader-<?=$uniq;?>-imgs" ></div>
				<div class="clear20" ></div>
				<div id="gi-uploader-someimguploader-<?=$uniq;?>-imgs-list" ></div>
			</div>
		</div>
		
	</div>

<!-- /Массовый загрузчик -->