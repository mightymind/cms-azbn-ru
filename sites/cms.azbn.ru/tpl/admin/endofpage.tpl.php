<?
// CMS Azbn.ru Публичная версия

?>
		
		</div>
		
		<div class="clear20" ></div>
	</div>
	
	<div class="row" >
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			<hr />
		</div>
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
			
			<div class="list-group">
				
				<?
				if($_SESSION['user']['right']['clear_cache']) {
				?>
				<a href="#clear_cache" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'cache', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить кеш</a>
				<?
				}
				?>
				
				<?
				if($_SESSION['user']['right']['clear_apicall']) {
				?>
				<a href="#clear_apicall" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'apicall', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить вызовы API</a>
				<?
				}
				?>
				
				<?
				if($_SESSION['user']['right']['clear_log']) {
				?>
				<a href="#clear_log" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'log', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить логи</a>
				<?
				}
				?>
				
			</div>
			
		</div>
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
			
			<div class="list-group">
				
				<?
				if($_SESSION['user']['right']['clear_usertask']) {
				?>
				<a href="#clear_usertask" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'usertask', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить таблицу заданий</a>
				<?
				}
				?>
				
				<?
				if($_SESSION['user']['right']['clear_uplfile']) {
				?>
				<a href="#clear_uplfile" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'uplfile', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить таблицу загрузок файлов</a>
				<?
				}
				?>
				
				<?
				if($_SESSION['user']['right']['clear_uplimg']) {
				?>
				<a href="#clear_uplimg" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'uplimg', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить таблицу загрузок изображений</a>
				<?
				}
				?>
				
				<?
				if($_SESSION['user']['right']['clear_ftsearch']) {
				?>
				<a href="#clear_ftsearch" class="list-group-item" onClick="AdminAPI.call({service:'clear', method:'ftsearch', callback:'ClearTable'});" ><img class="icon" src="/img/cms.azbn.ru/clear.png" /> Очистить поисковый индекс</a>
				<?
				}
				?>
				
			</div>
			
		</div>
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
			<p>
				<small class="text-muted" >Сайт управляется с помощью <a href="http://azbn.ru/" target="_blank" >CMS Azbn.ru</a> (<?=$this->FE->version['number'];?>)</small>
				<br />
				<small class="text-muted" >© Александр Зыбин, 2012-<?=date("Y");?></small>
			</p>
		</div>
		
		<div class="clear" ></div>
	</div>
	
</div>

<?
$this->FE->PluginMng->event('admin:viewer:body:after', $param);
?>

</body>
</html>