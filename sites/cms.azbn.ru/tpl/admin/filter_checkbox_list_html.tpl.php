<?
$filter4show=isset($param['filter4show'])?$this->FE->as_int($param['filter4show']):0;
$filter_list=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_filter']."` ORDER BY id");

$catalog=array(
	'list'=>array(),
	'structure'=>array()
	);

if(mysql_num_rows($filter_list)) {
	while($row=mysql_fetch_array($filter_list)) {
		$catalog['list'][$row['id']]=$row;
		$catalog['structure'][$row['parent']][$row['id']]=&$catalog['list'][$row['id']];
		}
	mysql_data_seek($filter_list,0);
	}

if(count($catalog['structure'][$filter4show])) {
	?>
			<hr />
			<div class="form-group">
				<label >Фильтры информации</label>
	<?
	foreach($catalog['structure'][$filter4show] as $index=>$entity) {
		showEntityWithChildren($param['edit_el'],$catalog,$index,'filter');
		}
	?>
			</div>
			<hr />
	<?
	}

function showEntityWithChildren(&$el,&$catalog,$entity_id,$entity_type='filter') {
	?>
	<div class="row" >

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			
			<div >
				<input type="checkbox" name="<?=$entity_type.'['.$entity_id.']';?>" value="1" <? if($el['filter'][$entity_id]) {echo 'checked';}?> /> <?=$catalog['list'][$entity_id]['title'];?>
			</div>
			
			<div class="clear">&nbsp;</div>
			
			<?
			if(count($catalog['structure'][$entity_id])) {
			?>
			<div class="row" >
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" >
					
				</div>
				<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11" >
					<table class="table table-striped table-condensed" >
						
						<tbody>
						<?
						foreach($catalog['structure'][$entity_id] as $index=>$entity) {
							?>
							<tr>
								<td >
							<?
							showEntityWithChildren($el,$catalog,$index,$entity_type);
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
	?>