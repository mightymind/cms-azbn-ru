<?
$uniq=$this->FE->randstr(12);
?>
<!-- Редактор -->

<script>

$(document).ready(function() {
	
	$('#div-PhotoAreaBlock-<?=$uniq;?>').hide();
	
	$('#div-DropImgOptimizer-<?=$uniq;?>').jqfeDropImgOptimizer2({
		max_width:1000,
		max_height:1000,
		callback:function(dataURL){
			
			$('#div-PhotoAreaBlock-<?=$uniq;?>').slideDown('fast');
			$('#span-PhotoArea-<?=$uniq;?>').jqfePhotoArea({
				image:dataURL,
				<?
				if(isset($param['img_form']['w']) && isset($param['img_form']['h'])) {
				?>
				ratio:<?=$param['img_form']['w'];?>/<?=$param['img_form']['h'];?>,
				<?
					}
				?>
				callback:function(dataURL){
					
					$.post('/admin/upload/dataurl/',{'path':'<?=$param['img_form']['path'];?>','img_to_save':dataURL},function(data){
						$('#fe-pa-result-<?=$uniq;?>').val(data);
						$('#div-PhotoAreaResult-<?=$uniq;?>').attr('src',data);
						});
					
					}
				});
			
			}
		});
	
	});

</script>

<div class="row" >
	
	<input type="hidden" id="fe-pa-result-<?=$uniq;?>" name="<?=$param['img_form']['name'];?>" value="<?=$param['img_form']['src'];?>" />
	
	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" >
		
		<div id="div-DropImgOptimizer-<?=$uniq;?>"></div>
	
	</div>
	
	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" >
		
		<div id="div-PhotoAreaBlock-<?=$uniq;?>" >
			<p>Обозначьте зону для создания изображения. Первый клик определяет левый верхний угол, второй - правый нижний.</p>
			<p><span id="span-PhotoArea-<?=$uniq;?>"></span></p>
		</div>
		
		<img id="div-PhotoAreaResult-<?=$uniq;?>" src="<?=$img['src'];?>" />
	
	</div>
	
</div>