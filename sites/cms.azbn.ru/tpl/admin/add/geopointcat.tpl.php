<?
if($_SESSION['user']['right']['change_geopointcat_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['parent']);?>);
	});
</script>
<div class="page-header" >
	<h3>Создание категории геоометок</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/geopointcat/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<div class="form-group">
				<label for="url" >URL</label>
				<input class="form-control" type="text" name="url" />
			</div>
			
			<?
			$this->FE->Viewer->form('admin/visible_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/geopointcat_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/seo_select_html',$param);
			?>
			
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
					'path'=>'geopointcat/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<div class="form-group">
				<label for="preview" >Пояснение</label>
				<textarea class="form-control" name="preview" ></textarea>
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-success" >Создать категорию</button>
			</div>
		
		</form>
	
		<div class="clear">&nbsp;</div>
	</div>
		
	<div class="clear">&nbsp;</div>
</div>
<?
	}
?>