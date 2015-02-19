<?
$gal=array();
if(mb_strlen($param['edit_el']['gal'],$this->FE->config['charset'])) {
	$_gal=explode(',',$param['edit_el']['gal']);
	if(count($_gal)) {
		foreach($_gal as $id=>$val) {
			$gal[$val]=1;
		}
	}
}
?>
<div class="form-group">
	<label for="gal[]" >Прикрепленные галереи</label>
	<select class="form-control" name="gal[]" multiple="multiple">
		<?
		
		$ilist=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_gallery']."` ORDER BY id");

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
				showGalWithChildren($gal,$catalog,$index);
				}
			}
		
		function showGalWithChildren(&$gal,&$catalog,$entity_id,$tab="- ") {
			?>
			<option value="<?=$entity_id;?>" <?if(isset($gal[$entity_id])){echo 'selected';}?> ><?=$tab.$catalog['list'][$entity_id]['title'];?></option>
			<?
			if(count($catalog['structure'][$entity_id])) {
				foreach($catalog['structure'][$entity_id] as $index=>$entity) {
					showGalWithChildren($gal,$catalog,$index,$tab.$tab);
					}
				}
			}
		
		?>
	</select>
</div>