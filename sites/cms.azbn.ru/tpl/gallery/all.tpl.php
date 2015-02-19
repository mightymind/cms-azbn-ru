<?
// Жажда версии 2.9 на движке ForEach 2.9
?>

<div class="row" >
	
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
		<?
		$param['mdl']['leftmenu_catalog']='leftmenu_catalog_gallery';
		$this->module_live('leftmenu_catalog',$param);
		?>
		<div class="clear" ></div>
	</div>
	
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >
		<?
		if(mysql_num_rows($param['item_list'])) {
			?>
			<div class="row" >
			<!--<a class="fancybox-button" data-fancybox-group="button" href="?.jpg" title="" ><img src="" alt="" /></a>-->
			<?
			while($row=mysql_fetch_array($param['item_list'])) {
				$row['param']=unserialize($row['param']);
				?>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
						
						<a href="<?=$row['img'];?>" class="fancybox-btn" data-fancybox-group="gallery-<?=$row['gal'];?>" title="<?=$row['title'];?>" ><img src="<?=$row['img'];?>" alt="<?=$row['title'];?>" /></a>
						
					</div>
				<?
				}
			mysql_data_seek($param['item_list'],0);
			?>
			</div>
			<?
			}
		?>
		<div class="clear20" ></div>
	</div>
	
</div>