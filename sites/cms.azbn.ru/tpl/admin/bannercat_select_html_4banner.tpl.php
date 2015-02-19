<div class="form-group">
	<label for="view_at" >Где разместить баннер?</label>
	<select class="form-control" type="text" name="view_at" >
		<option value="0" >Без позиции, нигде не показывать</option>
		<?
		
		$ilist=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_bannercat']."` ORDER BY id");

		$catalog=array(
			'list'=>array(),
			'structure'=>array()
			);

		if(mysql_num_rows($ilist)) {
			while($row=mysql_fetch_array($ilist)) {
				$catalog['list'][$row['id']]=$row;
				$catalog['structure'][$row['parent']][$row['id']]=&$catalog['list'][$row['id']];
				}
			mysql_data_seek($ilist,0);
			}
		
		if(count($catalog['structure'][0])) {
			foreach($catalog['structure'][0] as $index=>$entity) {
				showParentWithChildren($catalog,$index);
				}
			}
		
		function showParentWithChildren(&$catalog,$entity_id,$tab="- ") {
			?>
			<option value="<?=$entity_id;?>" ><?=$tab.$catalog['list'][$entity_id]['title'];?></option>
			<?
			if(count($catalog['structure'][$entity_id])) {
				foreach($catalog['structure'][$entity_id] as $index=>$entity) {
		showParentWithChildren($catalog,$index,$tab.$tab);
		}
				}
			}
		
		?>
	</select>
</div>