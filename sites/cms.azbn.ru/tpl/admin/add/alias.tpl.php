<?
if($_SESSION['user']['right']['change_alias']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Добавление адреса перенаправления</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/alias/" method="POST" >
			
			<div class="form-group">
				<label for="title" >Тип контента</label>
				<input class="form-control" type="text" name="type" value="text/html" />
			</div>
			
			<div class="form-group">
				<label for="title" >Перенаправлять с адреса</label>
				<input class="form-control" type="text" name="req" value="/adr_from" />
			</div>
			
			<div class="form-group">
				<label for="title" >Перенаправлять на адрес</label>
				<input class="form-control" type="text" name="to" value="/adr_to" />
			</div>
			
			<div class="form-group">
				<label for="sure" >Характер перенаправления</label>
				<select class="form-control" name="sure" >
					<option value="1" >точное совпадение</option>
					<option value="0" >замена части строки запроса</option>
				</select>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Добавить</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>