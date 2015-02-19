<?
$uniq=$this->FE->randstr(12);
$img=$param['img_form'];
?>
<!-- Редактор -->

<div id="fe-uplimg-<?=$uniq;?>" >

<script>

function setUplImgValue_<?=$uniq;?>(img) {
	$('#fe-uplimg-input-<?=$uniq;?>').val(img);
	$('#fe-uplimg-img-<?=$uniq;?>').attr({'src':img});
	}

$(document).ready(function() {
	
	$('#fe-uplimg-import-a-<?=$uniq;?>').on('click',function(){
		var link=prompt('Введите адрес изображения в интернете',$('#fe-uplimg-input-<?=$uniq;?>').val());
		if(link) {
			setUplImgValue_<?=$uniq;?>(link);
			}
		});
	
	<?
	if($_SESSION['user']['right']['upload_avatar']) {
	?>
	
	$('#fe-uplimg-upload-a-<?=$uniq;?>').hover(
	function(){
		$(this).jqfeFileUploader({
			action:'/admin/upload_img/?w='+$('#fe-uplimg-upload-w-<?=$uniq;?>').val()+'&h='+$('#fe-uplimg-upload-h-<?=$uniq;?>').val()+'&crop='+($('#fe-uplimg-upload-crop-<?=$uniq;?>').prop('checked')?1:0)+'&gray='+($('#fe-uplimg-upload-gray-<?=$uniq;?>').prop('checked')?1:0)+'&path=<?=$img['path'];?>',
			name:'icon_img',
			callback:function(file){
				setUplImgValue_<?=$uniq;?>(file);
			}
		});
	},
	function(){
		
	}
	);
	
	$('#fe-uplimg-uploadcopy-a-<?=$uniq;?>').on('click',function(){
		var link=prompt('Введите адрес изображения в интернете',$('#fe-uplimg-input-<?=$uniq;?>').val());
		if(link) {
			AdminAPI.callbacks.SetUplCopyImg_<?=$uniq;?>=function(resp) {
				setUplImgValue_<?=$uniq;?>(resp.response.item.dest);
				};
			AdminAPI.call({
				service:'import',
				method:'import_img',
				url:link,
				path:'<?=$img['path'];?>',
				callback:'SetUplCopyImg_<?=$uniq;?>'
				});
			}
		});
	
	<?
		}
	?>
	
	});

</script>

<div class="well well-sm">
	
	<div class="row">
		
		<?
		if($_SESSION['user']['right']['upload_avatar']) {
		?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
			<div class="row">
				
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<input type="number" id="fe-uplimg-upload-w-<?=$uniq;?>" class="form-control input-sm" value="<?=$img['w'];?>" min="1" max="1000" />
				</div>
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					/
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<input type="number" id="fe-uplimg-upload-h-<?=$uniq;?>" class="form-control input-sm" value="<?=$img['h'];?>" min="1" max="1000" />
				</div>
				
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					<input type="checkbox" id="fe-uplimg-upload-crop-<?=$uniq;?>" value="1" <? if($img['crop']) {echo 'checked';}?> />
					Обрезать до пропорц.
				</div>
				
				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
					<input type="checkbox" id="fe-uplimg-upload-gray-<?=$uniq;?>" value="1" <? if($img['gray']) {echo 'checked';}?> />
					Сделать серой
				</div>
				
			</div>
			
			<hr />
			
		</div>
		<?
		}
		?>
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			<?
			if($_SESSION['user']['right']['upload_avatar']) {
			?>
			<p><a href="#uploading" class="btn btn-primary btn-block" id="fe-uplimg-upload-a-<?=$uniq;?>" >загрузить с устройства</a></p>
			<p><a href="#uploading" class="btn btn-primary btn-block" id="fe-uplimg-uploadcopy-a-<?=$uniq;?>" >копир. на сервер по ссылке</a></p>
			<?
				}
			?>
			<p><a href="#uploading" class="btn btn-primary btn-block" id="fe-uplimg-import-a-<?=$uniq;?>" >по ссылке без копирования</a></p>
			
			<!--<p><small><input type="checkbox" id="fe-uplimg-upload-a-<?=$uniq;?>-crop-checkbox" value="1" checked /></small></p>-->
			
		</div>
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			
			<input type="hidden" id="fe-uplimg-input-<?=$uniq;?>" name="<?=$img['name'];?>" value="<?=$img['src'];?>" />
			<center><img id="fe-uplimg-img-<?=$uniq;?>" src="<?=$img['src'];?>" /></center>
			
		</div>
		
	</div>
	
</div>

</div>

<!-- /Редактор -->