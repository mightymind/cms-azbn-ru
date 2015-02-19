<?
if($_SESSION['user']['right']['change_faq_add']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Добавление записи в FAQ</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/faq/" method="POST" >
			
			<?
			if($_SESSION['user']['right']['change_faq_superuser']) {
			?>
			<input type="hidden" name="profile" value="0" />
			<?
				}
			?>
			
			<div class="row">
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<div class="form-group">
						<label for="date" >Дата создания</label>
						<input type="text" class="datepicker form-control" name="date" />
					</div>
					
					<div class="form-group">
						<label for="time" >Время создания (формат 23:59:59)</label>
						<input type="text" class="form-control maskedinput-time" name="time" value="00:00:00" />
					</div>
					
				</div>
				
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
					
					<!--
					<div class="form-group">
						<label for="sdate" >Дата начала</label>
						<input type="text" class="datepicker form-control" name="sdate" />
					</div>
					
					<div class="form-group">
						<label for="stime" >Время окончания (формат 23:59:59)</label>
						<input type="text" class="form-control" name="stime" value="00:00:00" />
					</div>
					-->
					
				</div>
				
			</div>
			
			
			<div class="form-group">
				<label for="visible" >Видимость</label>
				<select class="form-control" name="visible" >
					<option value="1" >отображать на сайте</option>
					<option value="0" >скрыть запись</option>
				</select>
			</div>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
					'upload_path'=>'faq/main_info',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'resp',
					'value'=>'<p></p>',
					'upload_path'=>'faq/resp',
					),
				);
			$this->FE->Viewer->form('admin/form_editor_html',$param);
			?>
			
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