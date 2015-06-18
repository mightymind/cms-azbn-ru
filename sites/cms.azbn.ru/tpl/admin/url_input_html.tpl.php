<?
$uniq=$this->FE->randstr(12);
?>
<script>
$(document).ready(function(){
	
	$('input[name="title"]').on('blur',function(){
		if($('input[name="url"]').val()=='') {
			AdminAPI.call({service:'fe', method:'ru2en', 'title':$(this).val(), callback:'GenURLFromTitle'});
		}
	});
	
	/*
	$('input[name="url"]').popover({
		html:true,
		animation:true,
		placement:'bottom',
		title:'Важно!',
		content:'Поле <b>url</b> используется для выборки записи. Должно быть уникальным',
		//template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
	}).popover('show');
	*/
	
});
</script>
<div class="form-group">
	<label for="url" >URL</label>
	<input class="form-control" type="text" name="url" value="<?=$param['edit_el']['url'];?>" />
</div>