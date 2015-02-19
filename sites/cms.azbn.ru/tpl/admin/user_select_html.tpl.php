<div class="form-group">
	<label for="user" >Автор записи</label>
	<select class="form-control" name="user" >
	<?
	$ulist=$this->FE->DB->dbSelect("SELECT * FROM `".$this->FE->DB->dbtables['t_user']."` ORDER BY rating");
	while($row=mysql_fetch_array($ulist)) {
		?>
		<option value="<?=$row['id'];?>" ><?=$row['view_as'];?></option>
		<?
		}
		?>
	</select>
</div>