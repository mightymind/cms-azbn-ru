<?
$uniq=$this->FE->randstr(12);
$img=$param['img_form'];
$img['max_w']=isset($img['max_w'])?$this->FE->as_int($img['max_w']):1000;
$img['max_h']=isset($img['max_h'])?$this->FE->as_int($img['max_h']):1000;

$img['preview']['max_w']=isset($img['preview']['max_w'])?$this->FE->as_int($img['preview']['max_w']):400;
$img['preview']['max_h']=isset($img['preview']['max_h'])?$this->FE->as_int($img['preview']['max_h']):400;
?>
<!-- Редактор -->

<div id="fe-uplimg-<?=$uniq;?>" >

<script>

$(document).ready(function() {
	
	function setUplImgValue_<?=$uniq;?>(img) {
		$('#fe-uplimg-input-<?=$uniq;?>').val(img);
		$('#fe-uplimg-img-<?=$uniq;?>').attr({'src':img});
	}
	
	function setPreviewImgValue_<?=$uniq;?>(img) {
		$('#fe-uplpreview-input-<?=$uniq;?>').val(img);
		$('#fe-uplpreview-img-<?=$uniq;?>').attr({'src':(img)});
	}
	
	$('#fe-uplimg-import-a-<?=$uniq;?>').on('click',function(){
		var link=prompt('Введите адрес изображения в интернете',$('#fe-uplimg-input-<?=$uniq;?>').val());
		if(link) {
			setUplImgValue_<?=$uniq;?>(link);
			}
		});
	
	$('#select-from-galleryitem-modal-galselect-<?=$uniq;?>').on('change',function(){
		//alert($(this).find('option:selected').attr('value'));
		$('#select-from-galleryitem-modal-imglist-<?=$uniq;?>').html('');
		AdminAPI.call({service:'galleryitem', method:'by_gallery', 'gal':$(this).find('option:selected').attr('value'), 'load_to':'<?=$uniq;?>', callback:'GetItemsFromGallery'});
		});
	
	<?
	if($_SESSION['user']['right']['upload_avatar']) {
	?>
	
	function genUploadedImg_<?=$uniq;?>() {
		
		var img = document.createElement("img");
		img.src = $('#fe-uplimg-input-<?=$uniq;?>').val();
		img.onload = function() {
			try {
			
			var w=img.width;
			var h=img.height;
			
			var canvas = document.createElement("canvas");
			canvas.setAttribute('width',w+'px');
			canvas.setAttribute('height',h+'px');
			var ctx = canvas.getContext('2d');
			ctx.drawImage(img, 0, 0, w, h);
			
			var res = canvas.toDataURL("image/png");
			
			$('.create-img-for-el-modal-realupdate-<?=$uniq;?>').unbind('change').bind('change',function(){
				genPhotoArea2_<?=$uniq;?>(res);
			});
			
			$('#create-img-for-el-modal-areablock-<?=$uniq;?>').show('fast',function(){
				genPhotoArea2_<?=$uniq;?>(res);
				$(this).bind('mousemove', function(){
					genPhotoArea2_<?=$uniq;?>(res);
					$(this).unbind('mousemove');
				});
			});
			
			} catch (err) {
				console.error(err.code);
			}
		};
		
	};
	
	function genPhotoArea2_<?=$uniq;?>(dataURL) {
		
		$('#create-img-for-el-modal-area-<?=$uniq;?>').jqfePhotoArea2({
			image:dataURL,
			width:parseInt($('#fe-uplimg-upload-w-<?=$uniq;?>').val()),
			height:parseInt($('#fe-uplimg-upload-h-<?=$uniq;?>').val()),
			//ratio:parseInt($('#fe-uplimg-upload-w-<?=$uniq;?>').val())/parseInt($('#fe-uplimg-upload-h-<?=$uniq;?>').val()),
			in_ratio:($('#fe-uplimg-upload-in_ratio-<?=$uniq;?>').prop('checked')?1:0),
			in_size:($('#fe-uplimg-upload-in_size-<?=$uniq;?>').prop('checked')?1:0),
			callback:function(dataURL_){
				
				$.post('/admin/upload/dataurl/',{'path':'<?=$param['img_form']['path'];?>','img_to_save':dataURL_},function(data){
					setUplImgValue_<?=$uniq;?>(data);
					$('#create-img-for-el-modal-cansel-<?=$uniq;?>').trigger('click');
					});
				
				},
			callback_preview:function(dataURL_){
				
				$.post('/admin/upload/dataurl/',{'path':'<?=$param['img_form']['path'];?>','img_to_save':dataURL_},function(data){
					setPreviewImgValue_<?=$uniq;?>(data);
					$('#create-img-for-el-modal-cansel-<?=$uniq;?>').trigger('click');
					});
				
				}
			});
		
	}
	
	$('#create-img-for-el-modal-areablock-<?=$uniq;?>').hide();
	genUploadedImg_<?=$uniq;?>();
	
	$('#fe-uplimg-upload-small-<?=$uniq;?>').jqfeDropImgOptimizer2({
		max_width:<?=$img['max_w'];?>,
		max_height:<?=$img['max_h'];?>,
		callback:function(dataURL){		
			$.post('/admin/upload/dataurl/',{'path':'<?=$param['img_form']['path'];?>','img_to_save':dataURL},function(data){
				setUplImgValue_<?=$uniq;?>(data);
			});
		}
	});
	
	$('#fe-uplimg-upload-orig-<?=$uniq;?>').jqfeDropImgUploader({
		action:'/admin/upload/file/?realurl=1&path=<?=$param['img_form']['path'];?>',
		name:'uploading_file',
		callback:function(file,response,counter){
			
			//file.name
			setUplImgValue_<?=$uniq;?>(response);
			
			}
	});
	
	$('#create-img-for-el-upload-<?=$uniq;?>').hover(
		function(){
			
			$(this).jqfeDropImgOptimizer2({
				max_width:<?=$img['max_w'];?>,
				max_height:<?=$img['max_h'];?>,
				callback:function(dataURL){
					
					$('.create-img-for-el-modal-realupdate-<?=$uniq;?>').unbind('change').bind('change',function(){
						genPhotoArea2_<?=$uniq;?>(dataURL);
					});
					$('#create-img-for-el-modal-areablock-<?=$uniq;?>').slideDown('fast');
					genPhotoArea2_<?=$uniq;?>(dataURL);
					
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

<!-- Modal -->
<div class="modal fade" id="create-img-for-el-modal-<?=$uniq;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Создание изображения</h4>
			</div>
		
			<div class="modal-body">
				
			
		<?
		if($_SESSION['user']['right']['upload_avatar']) {
		?>
			
			<div class="row">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<p><a href="#uploading" class="btn btn-primary btn-block" id="create-img-for-el-upload-<?=$uniq;?>" >Загрузить с локального диска</a></p>
				</div>
				
				<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
					<p><input type="checkbox" value="1" id="fe-uplimg-upload-in_size-<?=$uniq;?>" class="create-img-for-el-modal-realupdate-<?=$uniq;?>" <?if($img['in_size']) {echo 'checked';}?> /> Точно в размер</p>
					<p><input type="checkbox" value="1" id="fe-uplimg-upload-in_ratio-<?=$uniq;?>" class="create-img-for-el-modal-realupdate-<?=$uniq;?>" <?if($img['in_ratio']) {echo 'checked';}?> /> Соблюдать пропорции</p>
				</div>
				
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<p><input type="number" id="fe-uplimg-upload-w-<?=$uniq;?>" class="form-control input-sm create-img-for-el-modal-realupdate-<?=$uniq;?>" value="<?=$img['w'];?>" min="1" max="<?=$img['max_w'];?>" /></p>
				</div>
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
					<p>/</p>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					<p><input type="number" id="fe-uplimg-upload-h-<?=$uniq;?>" class="form-control input-sm create-img-for-el-modal-realupdate-<?=$uniq;?>" value="<?=$img['h'];?>" min="1" max="<?=$img['max_h'];?>" /></p>
				</div>
				
				<div class="clear10" ></div>
				
			</div>
			
		<?
		}
		?>
		
		
		<div id="create-img-for-el-modal-areablock-<?=$uniq;?>" >
			<div class="alert alert-danger" ><small>Обозначьте зону для создания изображения. Первый клик определяет левый верхний угол, второй - правый нижний.</small></div>
			<div class="clear10" ></div>
			<p><span id="create-img-for-el-modal-area-<?=$uniq;?>"></span></p>
			<div class="clear10" ></div>
			<div class="alert alert-success" ><small>Загруженная картинка преобразована, учитывая максимальный размер <?=$img['max_w'];?>x<?=$img['max_h'];?></small></div>
		</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" id="create-img-for-el-modal-cansel-<?=$uniq;?>" class="btn btn-default" data-dismiss="modal" >Отмена</button>
				<!--<button type="button" id="create-img-for-el-modal-create-<?=$uniq;?>" class="btn btn-primary" data-dismiss="modal" >Создать</button>-->
			</div>
			
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="select-from-galleryitem-modal-<?=$uniq;?>" tabindex="-1" role="dialog" aria-labelledby="mySelectModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="mySelectModalLabel">Выбор изображения</h4>
			</div>
		
			<div class="modal-body">
			
				<div class="row">
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						
						<div class="form-group">
							<label for="parent" >Галерея</label>
							<select class="form-control" id="select-from-galleryitem-modal-galselect-<?=$uniq;?>" >
								<option value="0" >Выберите галерею</option>
								<?
								
								$ilist=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_gallery']."` ORDER BY id");

								$catalog=array(
									'list'=>array(),
									'structure'=>array()
									);

								if(mysql_num_rows($ilist)) {
									while($row=mysql_fetch_array($ilist)) {
										$catalog['list'][$row['id']]=$row;
										$catalog['structure'][$row['parent']][$row['id']]=&$catalog['list'][$row['id']];
										}
									mysql_data_seek($ilist,0);
									}
								
								if(count($catalog['structure'][0])) {
									foreach($catalog['structure'][0] as $index=>$entity) {
										showGalleryWithChildren($catalog,$index);
										}
									}
								
								function showGalleryWithChildren(&$catalog,$entity_id,$tab="- ") {
									?>
									<option value="<?=$entity_id;?>" ><?=$tab.$catalog['list'][$entity_id]['title'];?></option>
									<?
									if(count($catalog['structure'][$entity_id])) {
										foreach($catalog['structure'][$entity_id] as $index=>$entity) {
											showGalleryWithChildren($catalog,$index,$tab.$tab);
											}
										}
									}
								
								?>
							</select>
						</div>
						
					</div>
					
					<div class="clear10" ></div>
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row" id="select-from-galleryitem-modal-imglist-<?=$uniq;?>" >
							
						</div>
					</div>
					
					<div class="clear10" ></div>
					
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" id="select-from-galleryitem-modal-cansel-<?=$uniq;?>" class="btn btn-default" data-dismiss="modal" >Отмена</button>
				<!--<button type="button" id="create-img-for-el-modal-create-<?=$uniq;?>" class="btn btn-primary" data-dismiss="modal" >Создать</button>-->
			</div>
			
		</div>
	</div>
</div>


<div class="well well-sm">
	
	<div class="row">
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			<?
			if($_SESSION['user']['right']['upload_avatar']) {
			?>
			<p><a href="#uploadmodify" class="btn btn-primary btn-block" id="fe-uplimg-upload-a-<?=$uniq;?>" data-toggle="modal" data-target="#create-img-for-el-modal-<?=$uniq;?>" >загрузить и обработать</a></p>
			<p><a href="#uploadsmall" class="btn btn-primary btn-block" id="fe-uplimg-upload-small-<?=$uniq;?>" >загрузить и уменьшить</a></p>
			<p><a href="#uploadorig" class="btn btn-primary btn-block" id="fe-uplimg-upload-orig-<?=$uniq;?>" >загрузить оригинал</a></p>
			<p><a href="#copylink" class="btn btn-primary btn-block" id="fe-uplimg-uploadcopy-a-<?=$uniq;?>" >копир. на сервер по ссылке</a></p>
			<?
				}
			?>
			<p><a href="#bylink" class="btn btn-primary btn-block" id="fe-uplimg-import-a-<?=$uniq;?>" >по ссылке без копирования</a></p>
			<p><a href="#bygalleryitem" class="btn btn-primary btn-block" id="fe-uplimg-galleryitem-a-<?=$uniq;?>" data-toggle="modal" data-target="#select-from-galleryitem-modal-<?=$uniq;?>" >выбрать из галерей</a></p>
			
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			
			<small>Изображение</small>
			<input type="hidden" id="fe-uplimg-input-<?=$uniq;?>" name="<?=$img['name'];?>" value="<?=$img['src'];?>" />
			<center><img id="fe-uplimg-img-<?=$uniq;?>" src="<?=$img['src'];?>" /></center>
			
		</div>
		
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			
			<small>Превью</small>
			<input type="hidden" id="fe-uplpreview-input-<?=$uniq;?>" name="<?=$img['preview']['name'];?>" value="<?=$img['preview']['src'];?>" />
			<center><img id="fe-uplpreview-img-<?=$uniq;?>" src="<?=$img['preview']['src'];?>" /></center>
			
		</div>
		
	</div>
	
</div>

</div>

<!-- /Редактор -->