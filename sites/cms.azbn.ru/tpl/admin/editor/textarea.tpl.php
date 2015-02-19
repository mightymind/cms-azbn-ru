<?
$uniq=$this->FE->randstr(12);
//$ufpath=$param['upload_path'].'/files';
//$uipath=$param['upload_path'].'/imgs';
?>
<!-- Редактор -->
<div class="clear10" ></div>

<div id="fe-editor-<?=$uniq;?>" >
	
	<div class="row" >
		<div id="fe-editor-html-<?=$uniq;?>" class="col-lg-12 col-sm-12" >
			<textarea id="fe-editor-text-<?=$uniq;?>" name="<?=$param['run_editor']['element']['name'];?>" rows="16" class="form-control" ><?=$param['run_editor']['element']['value'];?></textarea>
		</div>
	</div>
						
</div><!--/span-->

<!-- /Редактор -->

<div class="clear30" ></div>