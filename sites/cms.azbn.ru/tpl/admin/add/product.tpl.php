<?
if($_SESSION['user']['right']['change_product_add']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Добавление товара</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/product/" method="POST" >
			
			<div class="form-group">
				<label for="title" >Заголовок</label>
				<input class="form-control" type="text" name="title" />
			</div>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" />
			</div>
			
			<div class="form-group">
				<label for="visible" >Видимость</label>
				<select class="form-control" name="visible" >
					<option value="1" >отображать на сайте</option>
					<option value="0" >скрыть запись</option>
				</select>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/productcat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
			<div class="form-group">
				<label for="rating" >Рейтинг</label>
				<input type="number" class="form-control" name="rating" max="999999999" min="1" value="999999999" />
			</div>
			
			<div class="form-group">
				<label for="count" >Количество на складе, шт.</label>
				<input type="number" class="form-control" name="count" max="999999999" min="0" value="0" />
			</div>
			
			<div class="form-group">
				<label for="cost" >Цена</label>
				<input type="number" class="form-control" name="cost" max="999999999" min="0" value="0" />
			</div>
			
			<div class="form-group">
				<label for="oldcost" >Старая цена</label>
				<input type="number" class="form-control" name="oldcost" max="999999999" min="0" value="0" />
			</div>
			
			<div class="form-group">
				<label for="unit" >Единица измерения</label>
				<input class="form-control" type="text" name="unit" value="шт." />
			</div>
			
			<div class="form-group">
				<label for="uid" >Уникальный код товара</label>
				<input class="form-control" type="text" name="uid" value="<?=$this->FE->randstr(32);?>" />
			</div>
			
			<div class="form-group">
				<label for="img" >Изображение</label>
			<?
				$param['img_form']=array(
					'name'=>'img',
					'src'=>'/img/cms.azbn.ru/default.png',
					'w'=>170,
					'h'=>170,
					'crop'=>1,
					'gray'=>0,
					'path'=>'product/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<div class="form-group">
				<label for="preview" >Краткое содержание</label>
				<textarea class="form-control" name="preview" ></textarea>
			</div>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
					'upload_path'=>'product/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
			<div class="form-group">
				<label for="tag" >Теги (через точку с запятой!)</label>
				<input class="form-control" type="text" name="tag" />
			</div>
			
			<?
			$this->FE->Viewer->form('admin/gal_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/filter_checkbox_list_html',$param);
			?>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Добавить товар</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>