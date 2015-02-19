<?
$uniq=$this->FE->randstr(12);
?>
<!-- Редактор CLEditor -->
<!-- http://premiumsoftware.net/cleditor/gettingstarted -->
<link rel="stylesheet" type="text/css" href="/import/cms.azbn.ru/cleditor/jquery.cleditor.css" />
<script src="/import/cms.azbn.ru/cleditor/jquery.cleditor.min.js"></script>
<script>

$(document).ready(function() {
	
	$("#cl-editor-text-<?=$uniq;?>").cleditor({
		docType:'<!DOCTYPE html>',
		});
	
	});

</script>
						
<div class="row" >
	<div id="cl-editor-<?=$uniq;?>" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<textarea id="cl-editor-text-<?=$uniq;?>" name="<?=$param['run_editor']['element']['name'];?>" class="form-control" ><?=$param['run_editor']['element']['value'];?></textarea>
	</div>
</div>

<!-- /Редактор CLEditor -->

<div class="clear30" ></div>