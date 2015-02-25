<?
$uniq=$this->FE->randstr(12);
?>
<!-- Редактор CKEditor -->

<script src="//cdn.ckeditor.com/4.4.2/full/ckeditor.js"></script>
<script>

$(document).ready(function() {
	//$('textarea#ck-editor-text-<?=$uniq;?>').ckeditor();
	CKEDITOR.replace('ck-editor-text-<?=$uniq;?>',{
		allowedContent:true,
		//filebrowserBrowseUrl: '/browser/browse.php',
		filebrowserUploadUrl: '/admin/upload/import/?path=<?=$param['run_editor']['element']['upload_path'];?>',
		});
	});

</script>
						
<div class="row" >
	<div id="ck-editor-<?=$uniq;?>" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<textarea id="ck-editor-text-<?=$uniq;?>" name="<?=$param['run_editor']['element']['name'];?>" class="form-control" ><?=$param['run_editor']['element']['value'];?></textarea>
	</div>
</div>

<!-- /Редактор CKEditor -->

<div class="clear30" ></div>