<!DOCTYPE html>
<html>
	<head>
		<meta HTTP-EQUIV="Cache-Control" content="no-cache" />
		<meta name="viewport" content="width=1280">

		<title>Редактирование файла <?=$param['file']['name'];?></title>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link id="page_favicon" href="/img/cms.azbn.ru/favicon.png" rel="icon" type="image/x-icon" />
		
		<link href="/css/bs3/bootstrap.min.css" rel="stylesheet">
		
		<link href="/css/cms.azbn.ru/base.css?v=<?=$this->FE->date;?>" rel="stylesheet">
		<link href="/css/cms.azbn.ru/admin.css?v=<?=$this->FE->date;?>" rel="stylesheet">
		<style>
		textarea {
			width:100%;
			min-height:500px;
			}
		</style>
		
		<script src="http://yandex.st/jquery/2.1.1/jquery.min.js"></script>
		<script src="/js/bs3/bootstrap.min.js"></script>
		
		<!-- <script src="/js/jquery.jqfeFileUploader.js"></script> for delete -->
		<script src="/js/jquery.jqfeModal.js"></script>
		<script src="/js/jquery.jqfeInfoMsg.js"></script>
		
		<script src="/js/cms.azbn.ru/AdminAPI.js"></script>
		
		
		<script>
			$(document).ready(function() {
				
				AdminAPI.config.app_key='<?=$this->FE->config['admin_app_key'];?>';
				
				$('#save-btn').on('click', function(){
					AdminAPI.call({
						service:'fileman',
						method:'save_file',
						name:$('#file_name').val(),
						main_info:$('#file_main_info').val(),
						callback:'SaveFileResult',
						});
					});
				
				$('#reload-btn').on('click', function(){
					location.reload();
					});
				
				$('#nosave-btn').on('click', function(){
					if(confirm("Закрыть редактирование файла без сохранения?")){
						window.close();
						}
					});
				
				$('#delete-btn').on('click', function(){
					if(confirm("Удалить файл?")){
						AdminAPI.call({
							service:'fileman',
							method:'delete_file',
							name:$('#file_name').val(),
							callback:'SaveFileResult',
							});
						}
					});
				
				});
		</script>
		
	</head>
<body>
	
	<div class="container" >
		
		<div class="row" >
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				
				<div class="clear20" ></div>
				
				<a href="#save" class="btn btn-primary" id="save-btn" >Сохранить</a>
				<a href="#reload" class="btn btn-success" id="reload-btn" >Сбросить</a>
				<a href="#nosave" class="btn btn-warning" id="nosave-btn" >Не сохранять</a>
				<a href="#delete" class="btn btn-danger" id="delete-btn" >Удалить</a>
				
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				
				<div class="clear20" ></div>
				
				<input type="text" class="form-control" id="file_name" value="<?=$param['file']['name'];?>" />
				
				<div class="clear20" ></div>
				
				<textarea id="file_main_info" ><?=$param['file']['main_info'];?></textarea>
				
			</div>
			
		</div>
	
	</div>
	
</body>
</html>