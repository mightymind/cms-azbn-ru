<?
// CMS Azbn.ru Публичная версия

$site_obj=array(
	'page'=>'Страницы',
	'pagecat'=>'Разделы страниц',
	
	'post'=>'Посты',
	'postcat'=>'Разделы постов',
	
	'news'=>'Новости',
	'newscat'=>'Разделы новостей',
	
	'product'=>'Товары',
	'productcat'=>'Категории товаров',
	
	'gallery'=>'Галереи',
	'galleryitem'=>'Изображения',
	
	'geopoint'=>'Геометки',
	'geopointcat'=>'Разделы геометок',
	
	'calendar'=>'Календарь',
	);
//$entities=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_entity']."` ORDER BY id");
while($row=mysql_fetch_array($param['entity_list'])) {
	$site_obj[$row['url']]=$row['title'];
	$site_obj[$row['url'].'cat']=$row['title'].', разделы';
}

?>


<div class="row" >
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<hr />
		
		<h2>Поиск <i><?=$param['ftsearch']['text'];?></i> на сайте</h2>
		
		<div class="clear10" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" >
		
		
		<div class="list-group">
			<a href="#all" class="list-group-item active ftsearch-flt" data-flt="" ><span class="badge"><?=$this->FE->as_int($param['ftsearch']['count']['all']);?></span> Все</a>
			<?
			if(count($param['ftsearch']['count'])) {
				unset($param['ftsearch']['count']['all']);
				foreach($param['ftsearch']['count'] as $type=>$t_count) {
					?>
					<a href="#<?=$type;?>" class="list-group-item ftsearch-flt" data-flt="<?=$type;?>" ><span class="badge"><?=($t_count);?></span> <?=$site_obj[$type];?></a>
					<?
				}
			}
			?>
		</div>
		
		
		<div class="clear" ></div>
	</div>
	
	<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 ftsearch-block" >
		
		<?
		/*
		if(mysql_num_rows($param['ftsearch_list'])) {
			while($row=mysql_fetch_array($param['ftsearch_list'])) {
				
				}
			mysql_data_seek($param['ftsearch_list'],0);
			}
		*/
		if(count($param['item_list'])) {
			foreach($param['item_list'] as $row) {
				?>
				
				<div class="ftsearch-item ftsearch-item-<?=$row['ftsearch']['el_type'];?> panel panel-info">
					<!--
					<div class="panel-heading">
						<h3 class="panel-title"><?=$site_obj[$row['ftsearch']['el_type']];?></a></h3>
					</div>
					-->
					<div class="panel-body row">
						
						<?
						if(0 && $row['img']) {
						?>
						<div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
							<a href="<?=$row['url'];?>">
								<img class="" src="<?=$row['img'];?>" alt="<?=$row['title'];?>">
							</a>
						</div>
						<?
						}
						?>
						
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4 class=""><?=$site_obj[$row['ftsearch']['el_type']];?> &rarr; <a href="<?=$row['url'];?>" ><?=$row['title'];?></a></h4>
							<?if(isset($row['preview']) && $row['preview']!=''){?><p><?=$row['preview'];?></p><?}?>
							<!--<small class="text-muted" >Релевантность: <?=$row['ftsearch']['REL'];?></small>-->
						</div>
						
					</div>
				</div>
				
				<?
			}
		} else {
			?>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4>Извините, ничего не найдено.</h4>
				<p>Попробуйте переформулировать свой запрос.</p>
			</div>
			
			<?
		}
		?>
		
		<div class="clear" ></div>
	</div>
	
</div>