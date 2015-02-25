<?
$uniq=$this->FE->randstr(12);
$ufpath=$param['run_editor']['element']['upload_path'].'/files';
$uipath=$param['run_editor']['element']['upload_path'].'/imgs';
?>
<!-- Редактор -->
<div class="clear10" ></div>

<div id="fe-editor-<?=$uniq;?>" >

<script>

var fe_editor_<?=$uniq;?>={
	
	selection:{
		start:0,
		end:0,
		},
	
	store_text_id:'fe_editor_store_text',
	
	};

/*
$(document).keyup(function(event){
	if (event.keyCode == 27) {
		alert('escaped!');
		}
	});
*/

$(document).ready(function() {
	
	$('.popover-btn').popover({
		html:true,
		});
	
	$('.fe-editor-uploadfile-btn-<?=$uniq;?>').on('click',function(){
		var link=prompt('Вставьте адрес файла в интернете','');
		if(link) {
			fe_insert_tag_<?=$uniq;?>('','<a href="'+link+'" target=_blank >'+link+'</a>');
			}
		});
	
	$('.fe-editor-uploadimg-btn-<?=$uniq;?>').on('click',function(){
		var link=prompt('Вставьте адрес изображения в интернете','');
		if(link) {
			fe_insert_tag_<?=$uniq;?>('','<center><img src="'+link+'" width="" /></center>');
			}
		});
	
	$('.fe-editor-uploadsomeimg-btn-<?=$uniq;?>').on('click',function(){
		$('#fe-editor-someimguploader-<?=$uniq;?>-imgs-list').children('img').remove();
		$('#fe-editor-someimguploader-<?=$uniq;?>').jqfeModal();
		});
	
	$('.fe-editor-uploadsomefile-btn-<?=$uniq;?>').on('click',function(){
		$('#fe-editor-somefileuploader-<?=$uniq;?>-files-list').children('p').remove();
		$('#fe-editor-somefileuploader-<?=$uniq;?>').jqfeModal();
		});
	
	$('.fe-editor-restore-<?=$uniq;?>').on('click',function(){
		$('#fe-editor-text-<?=$uniq;?>').val(localStorage.getItem(fe_editor_<?=$uniq;?>.store_text_id));
		});
	
	$('#fe-editor-someimguploader-<?=$uniq;?>-imgs').jqfeDropImgOptimizer2({
		max_width:1000,
		max_height:1000,
		callback:function(dataURL){
			
			$.post('/admin/upload/dataurl/',{'path':'<?=$uipath;?>','img_to_save':dataURL},function(data){
				
				//fe_insert_tag_<?=$uniq;?>('','<p><center><img src="'+data+'" width="" /></center></p>\n');
				fe_insert_tag_<?=$uniq;?>('','<center><img src="'+data+'" width="" /></center>\n');
				
				$('<img/>',{
					src:data,
					class:'main_info_preview',
					}).appendTo($('#fe-editor-someimguploader-<?=$uniq;?>-imgs-list'));
				});
			
			}
		});
	
	$('#fe-editor-somefileuploader-<?=$uniq;?>-files').jqfeDropUploader({
		action:'/admin/upload/file/?path=<?=$ufpath;?>',
		name:'uploading_file',
		callback:function(file,response,counter){
			
			fe_insert_tag_<?=$uniq;?>('','<p><a href="'+response+'" >'+file.name+'</a></p>\n');
			$('<p><a href="'+response+'" >'+file.name+'</a></p>').appendTo($('#fe-editor-somefileuploader-<?=$uniq;?>-files-list'));
			
			}
		});
	
	
	$('#fe-editor-text-<?=$uniq;?>').on('mouseout',function(){
		fe_recalc_length_<?=$uniq;?>();
		});
	
	$('#fe-editor-text-<?=$uniq;?>').on('keyup',function(){
		localStorage.setItem(fe_editor_<?=$uniq;?>.store_text_id, $('#fe-editor-text-<?=$uniq;?>').val());
		fe_recalc_length_<?=$uniq;?>();
		});
	
	$('#fe-editor-text-<?=$uniq;?>').on('click',function(){
		fe_recalc_length_<?=$uniq;?>();
		});
	
	});
	
	function fe_recalc_length_<?=$uniq;?>() {
		var _area=$('#fe-editor-text-<?=$uniq;?>');
		var _length=_area.val().length;
		
		$('#fe-editor-symbol-count-<?=$uniq;?>').val(_length);
		$('#fe-editor-symbol-count-viewer-<?=$uniq;?>').html('Символов: '+_length);
		
		if (document.getSelection) {
			_area=document.getElementById('fe-editor-text-<?=$uniq;?>');
			
			//var _start=_area.selectionStart;
			//var _end=_area.selectionEnd;
			
			fe_editor_<?=$uniq;?>.selection.start=_area.selectionStart;
			fe_editor_<?=$uniq;?>.selection.end=_area.selectionEnd;
			
			$('#fe-editor-start-selection-<?=$uniq;?>').val(fe_editor_<?=$uniq;?>.selection.start);
			$('#fe-editor-end-selection-<?=$uniq;?>').val(fe_editor_<?=$uniq;?>.selection.end);
			
			$('#fe-editor-start-selection-viewer-<?=$uniq;?>').html('Начало выделения: '+fe_editor_<?=$uniq;?>.selection.start);
			$('#fe-editor-end-selection-viewer-<?=$uniq;?>').html('Конец выделения: '+fe_editor_<?=$uniq;?>.selection.end);
			} else {
				$('#fe-editor-start-selection-viewer-<?=$uniq;?>').html('');
				$('#fe-editor-end-selection-viewer-<?=$uniq;?>').html('');
				}
		}
	
	function fe_insert_tag_<?=$uniq;?>(stag,etag) {
		
		if (document.getSelection) {
			area=document.getElementById('fe-editor-text-<?=$uniq;?>');
			
			var selection_obj={
				start:fe_editor_<?=$uniq;?>.selection.start,
				end:fe_editor_<?=$uniq;?>.selection.start+stag.length+(fe_editor_<?=$uniq;?>.selection.end-fe_editor_<?=$uniq;?>.selection.start)+etag.length,
				};
			
			text=area.value.substring(0,
				fe_editor_<?=$uniq;?>.selection.start) +
				stag +
				area.value.substring(fe_editor_<?=$uniq;?>.selection.start, fe_editor_<?=$uniq;?>.selection.end) +
				etag +
				area.value.substring(fe_editor_<?=$uniq;?>.selection.end,area.value.length);
			
			area.value=text;
			
			area.setSelectionRange(selection_obj.start,selection_obj.end);
			}
		
		localStorage.setItem(fe_editor_<?=$uniq;?>.store_text_id, $('#fe-editor-text-<?=$uniq;?>').val());
		
		fe_recalc_length_<?=$uniq;?>();
		
		}
						</script>
						
						<input type="hidden" id="fe-editor-symbol-count-<?=$uniq;?>" />
						<input type="hidden" id="fe-editor-start-selection-<?=$uniq;?>" />
						<input type="hidden" id="fe-editor-end-selection-<?=$uniq;?>" />
						
						<div id="fe-editor-menu-<?=$uniq;?>" >
								
								<div class="btn-toolbar">
									
									<div class="btn-group">
										<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Menu <span class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#mm_view" onClick="$('#fe-editor-viewer-<?=$uniq;?>').html($('#fe-editor-text-<?=$uniq;?>').val()).show().jqfeModal();" >Просмотр</a></li>
											<li class="divider" ></li>
											<li><a class="fe-editor-restore-<?=$uniq;?>" href="#mm_restore" >Восстановить черновик</a></li>
										</ul>
									</div>
									
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">A <span class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#mm_add_a" onClick="fe_insert_tag_<?=$uniq;?>('<a href= target=_blank >','</a>');" >Site</a></li>
											<li><a href="#mm_add_a" onClick="fe_insert_tag_<?=$uniq;?>('<a href=mailto: target=_blank >','</a>');" >E-Mail</a></li>
										</ul>
									</div>
									
									<div class="btn-group">
										<a class="btn btn-success btn-sm" href="#mm_add_p" onClick="fe_insert_tag_<?=$uniq;?>('<p>','</p>');" >P</a>
										<a class="btn btn-success btn-sm" href="#mm_add_br" onClick="fe_insert_tag_<?=$uniq;?>('<br />','');" >BR</a>
										<a class="btn btn-success btn-sm" href="#mm_add_center" onClick="fe_insert_tag_<?=$uniq;?>('<center>','</center>');" >CENTER</a>
										<a class="btn btn-success btn-sm" href="#mm_add_cav" onClick="fe_insert_tag_<?=$uniq;?>('«','»');" >«..»</a>
									</div>
									
									<div class="btn-group">
										<a class="btn btn-danger btn-sm" href="#mm_add_ul" onClick="fe_insert_tag_<?=$uniq;?>('<ul>','</ul>');" >UL</a>
										<a class="btn btn-danger btn-sm" href="#mm_add_li" onClick="fe_insert_tag_<?=$uniq;?>('<li>','</li>');" >LI</a>
									</div>
									
									<div class="btn-group">
										<a class="btn btn-info btn-sm" href="#mm_add_b" onClick="fe_insert_tag_<?=$uniq;?>('<b>','</b>');" ><b>B</b></a>
										<a class="btn btn-info btn-sm" href="#mm_add_i" onClick="fe_insert_tag_<?=$uniq;?>('<i>','</i>');" ><i>I</i></a>
										<a class="btn btn-info btn-sm" href="#mm_add_u" onClick="fe_insert_tag_<?=$uniq;?>('<u>','</u>');" ><u>U</u></a>
									</div>
									
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">Upload <span class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a class="fe-editor-uploadfile-btn-<?=$uniq;?>" href="#mm_upload_file" >Файл по ссылке</a></li>
											<?
											if($_SESSION['user']['right']['upload_files']) {
											?>
											<li><a class="fe-editor-uploadsomefile-btn-<?=$uniq;?>" href="#mm_upload_somefile" >Локальные файлы</a></li>
											<?
												}
											?>
											<li class="divider"></li>
											<li><a class="fe-editor-uploadimg-btn-<?=$uniq;?>" href="#mm_upload_img" >Изображение по ссылке</a></li>
											<?
											if($_SESSION['user']['right']['upload_imgs']) {
											?>
											<li><a class="fe-editor-uploadsomeimg-btn-<?=$uniq;?>" href="#mm_upload_someimg" >Локальные изображения</a></li>
											<?
												}
											?>
										</ul>
									</div>
									
									<div class="btn-group">
										<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">Размер текста <span class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-6px&quot;>','</span>');" ><b>6px</b></a></li>
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-10px&quot;>','</span>');" ><b>10px</b></a></li>
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-14px&quot;>','</span>');" ><b>14px</b></a></li>
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-18px&quot;>','</span>');" ><b>18px</b></a></li>
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-22px&quot;>','</span>');" ><b>22px</b></a></li>
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-26px&quot;>','</span>');" ><b>26px</b></a></li>
											<li><a href="#mm_add_spanclass" onClick="fe_insert_tag_<?=$uniq;?>('<span class=&quot;editor-text-30px&quot;>','</span>');" ><b>30px</b></a></li>
										</ul>
									</div>
									
									<!--
									<div class="btn-group">
										<a class="btn btn-success btn-sm popover-btn" href="#mm_add_spanclass" data-container="body" data-toggle="popover" data-placement="right" data-content="content" data-title="title" >Текст</a>
									</div>
									-->
									
									<div class="btn-group">
										<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Шаблон <span class="caret"></span></button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#mm_p_justify" onClick="fe_insert_tag_<?=$uniq;?>('<p align=justify >','</p>');" >Абзац с выр. по ширине</a></li>
											<li><a href="#mm_p_left" onClick="fe_insert_tag_<?=$uniq;?>('<p align=left >','</p>');" >Абзац с левым выр.</a></li>
											<li><a href="#mm_p_center" onClick="fe_insert_tag_<?=$uniq;?>('<p align=center >','</p>');" >Абзац с выр. по центру</a></li>
											<li><a href="#mm_p_right" onClick="fe_insert_tag_<?=$uniq;?>('<p align=right >','</p>');" >Абзац с правым выр.</a></li>
											<!--<li class="divider"></li>-->
											<!--<li>Размер текста <input type="range" id="fe-editor-fontsize-range-<?=$uniq;?>" max="30" min="4" value="10" step="1" onChange="fe_insert_tag_<?=$uniq;?>('<span style=&quot;font-size:'+$('#fe-editor-fontsize-range-<?=$uniq;?>').val()+'px;&quot; >','</span>');"></li>-->
										</ul>
									</div>
									
								</div>
								
						</div>
						
						<div class="clear10" ></div>

						<div class="row" >
							<div id="fe-editor-html-<?=$uniq;?>" class="col-lg-12 col-sm-12" >
								<textarea id="fe-editor-text-<?=$uniq;?>" name="<?=$param['run_editor']['element']['name'];?>" rows="16" class="form-control" ><?=$param['run_editor']['element']['value'];?></textarea>
							</div>
							
							<div class="col-lg-12 col-sm-12" style="display:none;" >
								<div id="fe-editor-viewer-<?=$uniq;?>" class="well-small sandbox" ></div>
							</div>
							
							<div class="col-lg-12 col-sm-12" style="display:none;" >
								<div id="fe-editor-someimguploader-<?=$uniq;?>" >
									<!--
									<h3>Задайте ширину итоговых изображений</h3>
									<input type="range" name="fe-editor-someimguploader-imgsize-<?=$uniq;?>" max="1000" min="100" value="600" step="10" onChange="this.setAttribute('title',this.value);" />
									<div class="clear20" ></div>
									-->
									<h5><a href="#multiupload" class="btn btn-link" id="fe-editor-someimguploader-<?=$uniq;?>-imgs" >Выберите изображения</a> для загрузки. Поддерживается загрузка нескольких изображений одновременно</h5>
									<div class="clear20" ></div>
									<div id="fe-editor-someimguploader-<?=$uniq;?>-imgs-list" ></div>
								</div>
							</div>
							
							<div class="col-lg-12 col-sm-12" style="display:none;" >
								<div id="fe-editor-somefileuploader-<?=$uniq;?>" >
									<h3>Поле ниже служит для загрузки файлов на сервер</h3>
									<div class="clear20" ></div>
									<div id="fe-editor-somefileuploader-<?=$uniq;?>-files" ></div>
									<div class="clear20" ></div>
									<div id="fe-editor-somefileuploader-<?=$uniq;?>-files-list" class="well well-sm" ></div>
								</div>
							</div>
						</div>
						
						<div class="clear10" ></div>
						
						<div class="row" >
							<div class="col-lg-12 col-sm-12" >
								<small id="fe-editor-symbol-count-viewer-<?=$uniq;?>" class="text-muted" ></small>
								<small id="fe-editor-start-selection-viewer-<?=$uniq;?>" class="text-muted" ></small>
								<small id="fe-editor-end-selection-viewer-<?=$uniq;?>" class="text-muted" ></small>
							</div>
						</div>
						
</div><!--/span-->

<!-- /Редактор -->

<div class="clear30" ></div>