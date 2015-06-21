<?
// CMS Azbn.ru Публичная версия
?>

<div class="row" >
	
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
		<?
		//$param['mdl']['leftmenu_catalog']='leftmenu_catalog_page';
		//$this->module_live('leftmenu_catalog',$param);
		?>
		<div class="clear" ></div>
	</div>
	
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >
		
		<?=$param['cat_id']['title'];?>
		
		<?
		if(mysql_num_rows($param['item_list'])) {
			while($row=mysql_fetch_array($param['item_list'])) {
				$row['param']=unserialize($row['param']);
				?>
				<div class="row" >
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
						<small class="text-muted"><?=date("d.m.Y",$row['created_at']);?></small>
						<h4><a href="<?=$this->FE->CMS->genLink($row,'page',true);?>" ><?=$row['title'];?></a></h4>
						<p><?=$row['preview'];?></p>
						<?
						if(strlen($row['param']['yt_video'])) {
						?>
						<iframe width="100%" height="300" src="http://www.youtube.com/embed/<?=$row['param']['yt_video'];?>" frameborder="0" allowfullscreen="" ></iframe>
						<?
							}
						?>
						<hr />
						<div class="clear20" ></div>
					</div>
				</div>
				<?
				}
			mysql_data_seek($param['item_list'],0);
			}
		?>
		<div class="clear20" ></div>
	</div>
	
</div>