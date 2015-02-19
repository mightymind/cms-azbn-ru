<?
//$uniq=$this->FE->randstr(12);
// форма поиска по объектам
?>

<div class="pull-right" >
	
	<form method="GET" class="form-inline" role="form" >
		<div class="form-group">
			<input type="text" class="form-control" name="search" value="<?=$param['search_str'];?>" placeholder="Поиск по разделу" />
		</div>
		<input type="submit" class="btn btn-primary" value="Найти" />
	</form>
	
</div>