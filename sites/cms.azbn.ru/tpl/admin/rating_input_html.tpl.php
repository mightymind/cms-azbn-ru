<?
$rating=$this->FE->as_int($param['edit_el']['rating']);
$rating=$rating?$rating:999999999;
?>
<div class="form-group">
	<label for="rating" >Позиция (рейтинг)</label>
	<input type="number" class="form-control" name="rating" max="999999999" min="1" value="<?=$rating;?>" />
</div>