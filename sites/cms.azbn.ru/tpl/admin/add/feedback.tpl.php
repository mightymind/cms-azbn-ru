<?
if($_SESSION['user']['right']['change_feedback_add']) {
?>
<script>
$(document).ready(function(){
	//$('select[name="visible"]').val();
	//$('select[name="parent"]').val(<?=$this->FE->as_int($_GET['cat']);?>);
	});
</script>
<div class="page-header" >
	<h3>Добавление записи в обратную связь</h3>
</div>

<div class="row" >
	
	<div class="col-sm-12 col-lg-12" >
		
		<form action="/admin/create/feedback/" method="POST" >
			
			<?
			if($_SESSION['user']['right']['change_feedback_superuser']) {
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
				<label for="view_as" >Подпись автора</label>
				<input class="form-control" type="text" name="view_as" />
			</div>
			
			<div class="form-group">
				<label for="phone" >Телефон</label>
				<input class="form-control" type="text" name="phone" />
			</div>
			
			<div class="form-group">
				<label for="email" >E-mail</label>
				<input class="form-control" type="text" name="email" />
			</div>
			
			<?
			$this->FE->Viewer->form('admin/visible_select_html',$param);
			?>
			
			<?
			$param['run_editor']=array(
				'element'=>array(
					'name'=>'main_info',
					'value'=>'<p></p>',
					'upload_path'=>'feedback/main_info',
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