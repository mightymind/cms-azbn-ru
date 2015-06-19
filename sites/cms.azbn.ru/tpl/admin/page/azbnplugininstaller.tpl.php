<?
// CMS Azbn.ru Публичная версия

$text = $this->FE->_get('text');
if($text != '') {
	$json_str = file_get_contents('http://azbn.ru/cmspluginstore/search/?text='.urlencode($text));
	$json = json_decode($json_str, true);
	$title = 'Поиск <u>'.$text.'</u> в <a href="/admin/page/azbnplugininstaller/" >хранилище плагинов Azbn.ru</a>';
} else {
	$json_str = file_get_contents('http://azbn.ru/cmspluginstore/top/');
	$json = json_decode($json_str, true);
	$title = 'Топ-5 в хранилище плагинов Azbn.ru';
}

?>

<div class="page-header" >
	
	<div class="pull-right" >
		
		<form method="GET" action="/admin/page/azbnplugininstaller/" class="form-inline" role="form" >
			<div class="form-group">
				<input type="text" class="form-control" name="text" value="<?=$text;?>" placeholder="Поиск в хранилище плагинов" />
			</div>
			<input type="submit" class="btn btn-primary" value="Найти" />
		</form>
		
	</div>
	
	<h3><?=$title;?></h3>
</div>
		<?
		if(count($json)) {
			foreach($json as $plugin) {
			$installed=$this->FE->DB->dbSelectFirstRow("SELECT * FROM `".$this->FE->DB->dbtables['t_plugin']."` WHERE (azbn_id='{$plugin['azbn_id']}')");
			if($installed['id']) {
				$disable=true;
			} else {
				$disable=false;
			}
			?>
		<div class="row" >
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 alert alert-info" >
				<p><h4><?=$plugin['title'];?></h4></p>
				<p><?=$plugin['preview'];?></p>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
				<form method="POST" action="/admin/create/plugin/" >
					<input type="hidden" name="url" value="http://azbn.ru/cmspluginstore/item/<?=$plugin['azbn_id'];?>/" />
					<?
					if($disable) {
						?>
						<button type="submit" class="btn btn-primary" disabled >Установлен</button>
						<?
					} else {
						?>
						<button type="submit" class="btn btn-danger" >Установить</button>
						<?
					}
					?>
				</form>
			</div>
			<hr />
		</div>
			<?
			}
		}
		?>