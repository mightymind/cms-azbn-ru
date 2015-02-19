<?

function showEntityWithChildren(&$catalog,$entity_id,$entity_type='bannercat') {
	?>
	<div class="row" >

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			
			<div class="pull-right" >
				<small>
					
					<a href="/admin/edit/<?=$entity_type;?>/<?=$entity_id;?>/" title="Редактировать" ><img class="icon" src="/img/cms.azbn.ru/edit.png" /></a>
					<a class="confirm-delete" href="/admin/delete/<?=$entity_type;?>/<?=$entity_id;?>/" title="Удалить" ><img class="icon" src="/img/cms.azbn.ru/delete.png" /></a>
					<a href="/admin/add/<?=$entity_type;?>/?parent=<?=$entity_id;?>" title="Создать подкатегорию" ><img class="icon" src="/img/cms.azbn.ru/add_child.png" /></a>
					
				</small>
			</div>
			
			<div >
				<h4><?=$catalog['list'][$entity_id]['title'];?></h4>
				
				<div class="clear10">&nbsp;</div>
			</div>
			
			<div class="clear">&nbsp;</div>
			
			<?
			if(count($catalog['structure'][$entity_id])) {
			?>
			<div class="row" >
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
					
				</div>
				<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" >
					<table class="table table-striped table-bordered table-hover table-condensed" >
						
						<tbody>
						<?
						foreach($catalog['structure'][$entity_id] as $index=>$entity) {
							?>
							<tr>
								<td >
							<?
							showEntityWithChildren($catalog,$index,$entity_type);
							?>
								</td>
							</tr>
							<?
							}
						?>
						</tbody>
						
					</table>
				</div>
			</div>
			<?
				}
			?>
			
			<div class="clear">&nbsp;</div>
		</div>
								
		<div class="clear">&nbsp;</div>
	</div>
	<?
	}

$catalog=array(
	'list'=>array(),
	'structure'=>array()
	);

if(mysql_num_rows($param['el_list'])) {
	while($row=mysql_fetch_array($param['el_list'])) {
		$catalog['list'][$row['id']]=$row;
		$catalog['structure'][$row['parent']][$row['id']]=&$catalog['list'][$row['id']];
		}
	mysql_data_seek($param['el_list'],0);
	}

?>
<div class="page-header" >
	<h3>
		Список позиций баннеров
		<a href="/admin/add/bannercat/" title="Создать позицию" ><img class="icon" src="/img/cms.azbn.ru/add.png" /></a>
	</h3>
</div>
	
	<?
	if(count($catalog['structure'][0])) {
		foreach($catalog['structure'][0] as $index=>$entity) {
			showEntityWithChildren($catalog,$index,'bannercat');
			}
		}
	?>