<?
if($_SESSION['user']['right']['change_postcat_edit']) {
?>
<script>
$(document).ready(function(){
	$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['parent']);?>);
	});
</script>
<div class="page-header" >
	<h3>Создание категории</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/postcat/" method="POST" >
			
			<?
			$this->FE->Viewer->form('admin/title_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/url_input_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/visible_select_html',$param);
			?>
			
			<?
			$this->FE->Viewer->form('admin/postcat_select_html',$param);
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
					'path'=>'postcat/img',
					);
				$this->FE->Viewer->form('admin/avatar_upload_html',$param);
				?>
			</div>
			
			<?
			$this->FE->Viewer->form('admin/preview_textarea_html',$param);
			?>
			
			<?
			$this->FE->PluginMng->event('admin:viewer:before_create_btn', $param);
			?>
			
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