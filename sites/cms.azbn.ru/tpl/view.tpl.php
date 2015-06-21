<?
// CMS Azbn.ru Публичная версия

var_dump($param['item_id']);
/*
<div class="view-page" >

	<div class="view-page-body border-radius-right" >
		
		<div class="view-page-body-header" itemscope itemtype="http://schema.org/ImageObject" >
			
			<img class="view-page-icon border-radius" src="<?=$param['item_id']['img'];?>" itemprop="contentUrl" />
			
			<div class="view-page-title-block" >
				<!--<h4 class="italic" ><?=date("d.m.Y",$param['item_id']['created_at']);?></h4>-->
				<h4 class="italic" ><?=date("d.m.Y",$param['item_id']['date']);?></h4>
				<h2 class="orange" itemprop="description" ><?=$param['item_id']['title'];?></h2>
			</div>
			
		</div>
		
		<div class="view-page-body-body sandbox" >
			<?=$param['item_id']['main_info'];?>
		</div>
		
	</div>

</div>
*/
?>