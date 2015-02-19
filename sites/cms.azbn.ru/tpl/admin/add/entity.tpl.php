<?
if($_SESSION['user']['right']['change_entity_add']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['parent']);?>);
	});
</script>
<div class="page-header" >
	<h3>Создание сущности</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/entity/" method="POST" >
			
			<div class="form-group">
				<label for="title" >Заголовок</label>
				<input class="form-control" type="text" name="title" />
			</div>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" />
			</div>
			
			<div class="form-group">
				<label for="ftsearch" >Поисковая индексация</label>
				<select class="form-control" name="ftsearch" >
					<option value="1" >производится</option>
					<option value="0" >не производится</option>
				</select>
			</div>
			
			<div class="form-group">
				<label for="" >Необходимые поля для категорий</label>
				
				<table class="table table-striped table-bordered table-hover table-condensed userright-as-table" >
					<tbody>
						
						<tr >
							<td ><input type="checkbox" name="cat[img]" value="1" /></td>
							<td width="97%">Картинка</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="cat[preview]" value="1" /></td>
							<td >Пояснение</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="cat[main_info]" value="1" /></td>
							<td >Основной текст</td>
						</tr>
					
					</tbody>
				</table>
				
				<div class="clear20" ></div>
				
				<label for="" >Необходимые поля для записей</label>
				
				<table class="table table-striped table-bordered table-hover table-condensed userright-as-table" >
					<tbody>
						
						<tr >
							<td ><input type="checkbox" name="item[rating]" value="1" /></td>
							<td width="97%" >Рейтинг (позиция)</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[uid]" value="1" /></td>
							<td >Уникальный ID</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[oldcost]" value="1" /></td>
							<td >Старая цена</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[cost]" value="1" /></td>
							<td >Цена</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[count]" value="1" /></td>
							<td >Количество</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[view_as]" value="1" /></td>
							<td >"Отображать как"</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[img]" value="1" /></td>
							<td >Картинка</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[gal]" value="1" /></td>
							<td >Прикрепленные галереи</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[preview]" value="1" /></td>
							<td >Пояснение</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[tag]" value="1" /></td>
							<td >Теги</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[main_info]" value="1" /></td>
							<td >Основной текст</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[coord]" value="1" /></td>
							<td >Координаты</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[start_at]" value="1" /></td>
							<td >Дата и время начала</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[stop_at]" value="1" /></td>
							<td >Дата и время окончания</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[profile]" value="1" /></td>
							<td >Профиль посетителя</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[filter]" value="1" /></td>
							<td >Фильтры</td>
						</tr>
						
						<tr >
							<td ><input type="checkbox" name="item[yt_video]" value="1" /></td>
							<td >YouTube-видео</td>
						</tr>
						
					</tbody>
				</table>
				
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Создать</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>