<?
// CMS Azbn.ru Публичная версия
?>

<div class="row" >
	
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
		<?
		$param['mdl']['leftmenu_catalog']='leftmenu_catalog_geopoint';
		$this->module_live('leftmenu_catalog',$param);
		?>
		<div class="clear" ></div>
	</div>
	
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >
		<div id="obj-map" style="width: 100%; height: 500px; padding: 0; margin: 0;" ></div>
		<div id="obj-list" ></div>
		<div class="clear20" ></div>
	</div>
	
</div>